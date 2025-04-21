
<?php
require('Includes/essentials.php');
require('Includes/db_configuration.php'); // Include DB config
adminLogin();

// Fetch Dashboard Data
$total_bookings = 0;
$pending_queries = 0;
$active_packages = 0;
$total_reviews = 0;
$recent_bookings = [];
$recent_queries = [];

// Total Bookings
$bookings_q = select("SELECT COUNT(id) AS count FROM `bookings`");
if ($bookings_q && mysqli_num_rows($bookings_q) > 0) {
    $bookings_res = mysqli_fetch_assoc($bookings_q);
    $total_bookings = $bookings_res['count'];
}

// Pending User Queries (assuming 'seen' = 0 means pending)
$queries_q = select("SELECT COUNT(sr_no) AS count FROM `user_queries` WHERE `seen`=?", [0], 'i');
if ($queries_q && mysqli_num_rows($queries_q) > 0) {
    $queries_res = mysqli_fetch_assoc($queries_q);
    $pending_queries = $queries_res['count'];
}

// Active Packages (assuming 'status' = 1 means active)
$packages_q = select("SELECT COUNT(id) AS count FROM `packages` WHERE `status`=?", [1], 'i');
if ($packages_q && mysqli_num_rows($packages_q) > 0) {
    $packages_res = mysqli_fetch_assoc($packages_q);
    $active_packages = $packages_res['count'];
}

// Total Reviews
$reviews_q = select("SELECT COUNT(id) AS count FROM `reviews`");
if ($reviews_q && mysqli_num_rows($reviews_q) > 0) {
    $reviews_res = mysqli_fetch_assoc($reviews_q);
    $total_reviews = $reviews_res['count'];
}

// Fetch Recent Bookings (Last 5)
// Assuming 'booking_date' or a similar timestamp column exists in 'bookings' table
// If not, you might need to order by 'id' DESC if it's auto-incrementing
// Also joining with packages to get package name
$recent_bookings_q = select(
    "SELECT b.id, b.name AS guest_name, p.name AS package_name, b.check_in
     FROM `bookings` b
     LEFT JOIN `packages` p ON b.package_id = p.id
     ORDER BY b.id DESC
     LIMIT 5"
);
if ($recent_bookings_q) {
    while($row = mysqli_fetch_assoc($recent_bookings_q)) {
        $recent_bookings[] = $row;
    }
}

// Fetch Recent Queries (Last 5) - Assuming 'date' column exists
$recent_queries_q = select("SELECT `sr_no`, `name`, `subject`, `date`, `seen` FROM `user_queries` ORDER BY `sr_no` DESC LIMIT 5");
if ($recent_queries_q) {
    while($row = mysqli_fetch_assoc($recent_queries_q)) {
        $recent_queries[] = $row;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('Includes/links.php'); ?>
    <style>
        .dashboard-card {
            border-radius: 8px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .dashboard-card .card-body {
            position: relative;
            padding-bottom: 50px; /* Space for the button */
        }
        .dashboard-card .card-icon {
            font-size: 3rem; /* Larger icons */
            opacity: 0.8;
        }
        .dashboard-card .card-link {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 30px); /* Button width */
        }
        .stat-number {
           font-size: 2.5rem;
           font-weight: 600;
        }
        .activity-section .table-responsive,
        .activity-section .list-group {
            max-height: 300px; /* Increased height */
            overflow-y: auto;
        }
        .activity-section .table th {
            font-size: 0.9rem;
            font-weight: 600;
        }
         .activity-section .table td,
         .activity-section .list-group-item {
            font-size: 0.85rem;
        }
        .query-item .badge {
            font-size: 0.7rem;
        }
         /* Custom scrollbar for webkit browsers */
        .activity-section ::-webkit-scrollbar {
            width: 5px;
        }
        .activity-section ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .activity-section ::-webkit-scrollbar-thumb {
            background: #adb5bd; /* Lighter gray */
            border-radius: 10px;
        }
        .activity-section ::-webkit-scrollbar-thumb:hover {
            background: #555; /* Darker on hover */
        }
    </style>
</head>

<body class="bg-light">

    <?php require('Includes/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="mb-0 h-font">DASHBOARD OVERVIEW</h3>
                </div>

                <!-- Summary Cards Row -->
                <div class="row">
                    <!-- Total Bookings Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card text-center text-primary border-primary dashboard-card shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="mb-2">
                                    <i class="bi bi-journal-check card-icon"></i>
                                </div>
                                <h5 class="card-title">Total Bookings</h5>
                                <p class="card-text stat-number"><?= $total_bookings ?></p>
                                <a href="bookings.php" class="btn btn-sm btn-outline-primary card-link">View Details</a>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Queries Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card text-center text-warning border-warning dashboard-card shadow-sm h-100">
                             <div class="card-body d-flex flex-column justify-content-center">
                                <div class="mb-2">
                                    <i class="bi bi-patch-question card-icon"></i>
                                </div>
                                <h5 class="card-title">Pending Queries</h5>
                                <p class="card-text stat-number"><?= $pending_queries ?></p>
                                <a href="user_queries.php" class="btn btn-sm btn-outline-warning card-link">Manage Queries</a>
                            </div>
                        </div>
                    </div>
                    <!-- Active Packages Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                         <div class="card text-center text-success border-success dashboard-card shadow-sm h-100">
                             <div class="card-body d-flex flex-column justify-content-center">
                                <div class="mb-2">
                                    <i class="bi bi-box-seam card-icon"></i>
                                </div>
                                <h5 class="card-title">Active Packages</h5>
                                <p class="card-text stat-number"><?= $active_packages ?></p>
                                <a href="packages.php" class="btn btn-sm btn-outline-success card-link">Manage Packages</a>
                            </div>
                        </div>
                    </div>
                    <!-- Total Reviews Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                         <div class="card text-center text-info border-info dashboard-card shadow-sm h-100">
                             <div class="card-body d-flex flex-column justify-content-center">
                                <div class="mb-2">
                                    <i class="bi bi-star-half card-icon"></i>
                                </div>
                                <h5 class="card-title">Total Reviews</h5>
                                <p class="card-text stat-number"><?= $total_reviews ?></p>
                                <a href="add_review.php" class="btn btn-sm btn-outline-info card-link">View Reviews</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Summary Row -->

                <!-- Recent Activity Section -->
                <div class="row mt-4 activity-section">
                    <!-- Recent Bookings -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><i class="bi bi-calendar-check me-2"></i>Recent Bookings</h5>
                                <div class="table-responsive">
                                    <?php if (empty($recent_bookings)): ?>
                                        <div class="alert alert-light text-center" role="alert">
                                          No recent bookings found.
                                        </div>
                                    <?php else: ?>
                                        <table class="table table-sm table-hover table-striped">
                                            <thead class="table-light sticky-top">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Guest</th>
                                                    <th>Package</th>
                                                    <th>Check-in</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($recent_bookings as $booking): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($booking['id']) ?></td>
                                                    <td><?= htmlspecialchars($booking['guest_name']) ?></td>
                                                    <td><?= htmlspecialchars($booking['package_name'] ?? 'N/A') ?></td>
                                                    <td><?= date('d M Y', strtotime($booking['check_in'])) ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($recent_bookings)): ?>
                                <a href="bookings.php" class="btn btn-sm custom-bg text-white float-end mt-2">View All Bookings</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Queries -->
                    <div class="col-lg-6 mb-4">
                         <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><i class="bi bi-envelope-paper me-2"></i>Recent Queries</h5>
                                <div class="list-group list-group-flush">
                                    <?php if (empty($recent_queries)): ?>
                                        <div class="alert alert-light text-center" role="alert">
                                          No recent queries found.
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($recent_queries as $query): ?>
                                        <a href="user_queries.php#query<?= $query['sr_no'] ?>" class="list-group-item list-group-item-action query-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1 fw-bold"><?= htmlspecialchars($query['name']) ?></h6>
                                                <small class="text-muted"><?= date('d M Y', strtotime($query['date'])) ?></small>
                                            </div>
                                            <p class="mb-1 text-truncate"><?= htmlspecialchars($query['subject']) ?></p>
                                            <small>
                                                <?php if ($query['seen'] == 0): ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success">Read</span>
                                                <?php endif; ?>
                                            </small>
                                        </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($recent_queries)): ?>
                                    <a href="user_queries.php" class="btn btn-sm custom-bg text-white float-end mt-2">View All Queries</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Recent Activity Row -->

            </div> <!-- End main content column -->
        </div> <!-- End main row -->
    </div> <!-- End main container -->


    <?php require('Includes/scripts.php'); ?>
    <script>
        // Optional: Add JS for dashboard specific interactions if needed later
    </script>
</body>

</html>
