<?php
require('../Includes/db_Configuration.php');
require('../Includes/essentials.php');
adminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $con->real_escape_string($_POST['name']);
    $review = $con->real_escape_string($_POST['review']);
    $rating = intval($_POST['rating']);

    // Initialize an empty string for image path
    $image_path = '';

    if (!empty($_FILES['profile_image']['name'])) {
        // Generate a unique name for the image to avoid conflicts
        $img_name = time() . '_' . basename($_FILES['profile_image']['name']);
        $target_dir = 'uploads/reviews/'; // Save images to this directory
        $target_file = $target_dir . $img_name;

        // Create the directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            // Save only the relative path of the image in the database
            $image_path = $target_dir . $img_name;
        }
    }

    // Prepare and execute the SQL query to insert review data
    $stmt = $con->prepare("INSERT INTO reviews (name, review, rating, profile_image, added_on) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssis", $name, $review, $rating, $image_path);

    // Execute the statement and provide feedback
    if ($stmt->execute()) {
        echo "<script>alert('Review added successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error adding review.'); window.history.back();</script>";
    }

    // Close the prepared statement
    $stmt->close();
}
?>
