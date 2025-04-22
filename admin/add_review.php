<?php
require('Includes/essentials.php');
require('Includes/db_Configuration.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Reviews</title>
    <?php require('Includes/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('Includes/header.php'); ?>

    <div class="container-fluid main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">REVIEWS</h3>
                <!-- Reviews section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">User Reviews</h5>
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn custom-bg shadow-none btn-sm text-white"
                                data-bs-toggle="modal" data-bs-target="#review-settings">
                                <i class="bi bi-pencil-square"></i> Add
                            </button> -->
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="custom-bg text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Review</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Profile</th>
                                        <th scope="col">Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = $con->query("SELECT * FROM reviews ORDER BY added_on DESC");
                                    $i = 1;
                                    while ($row = $res->fetch_assoc()):
                                        // Get the profile image path from the database (like 'uploads/reviews/xyz.jpg')
                                        $db_img = $row['profile_image'];

                                        // Path to check file existence on server
                                        $server_path = __DIR__ . '/../' . $db_img;

                                        // Final image path for browser (relative URL)
                                        $profile_img = (!empty($db_img) && file_exists($server_path))
                                            ? '../' . $db_img // prepend ../ if admin panel is in subfolder
                                            : '../uploads/reviews/user.png';
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= htmlspecialchars($row['name']) ?></td>
                                            <td><?= htmlspecialchars($row['review']) ?></td>
                                            <td><?= intval($row['rating']) ?>/5</td>
                                            <td>
                                                <img src="<?= $profile_img ?>" width="40" height="40"
                                                    class="rounded-circle">
                                                
                                            </td>
                                            <td><?= $row['added_on'] ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Review Modal -->

            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $review = $conn->real_escape_string($_POST['review']);
        $rating = intval($_POST['rating']);

        $image_path = '';
        if (!empty($_FILES['profile_image']['name'])) {
            $img_name = time() . '_' . basename($_FILES['profile_image']['name']);
            $target_dir = 'uploads/reviews/';
            $target_file = $target_dir . $img_name;

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                $image_path = $target_file;
            }
        }

        $stmt = $conn->prepare("INSERT INTO reviews (name, review, rating, profile_image, added_on) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssis", $name, $review, $rating, $image_path);

        if ($stmt->execute()) {
            echo "<script>alert('Review added successfully!'); window.location.href='add_review.php';</script>";
        } else {
            echo "<script>alert('Error adding review.');</script>";
        }

        $stmt->close();
    }
    ?>

    <?php require('Includes/scripts.php'); ?>
</body>

</html>
