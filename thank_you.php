<?php
session_start();
require('admin/Includes/db_Configuration.php');

if (!isset($_SESSION['booking_id'])) {
    echo "No booking found.";
    exit;
}

$booking_id = $_SESSION['booking_id'];

$query = "SELECT * FROM bookings WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    echo "Booking not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pawana Camping - Thank you</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('IncludeFiles/links.php'); ?>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 60px auto;
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h1 {
            color: #16a34a;
        }
        .detail {
            margin: 12px 0;
            font-size: 16px;
        }
        .label {
            font-weight: 600;
            color: #374151;
        }
        .value {
            color: #111827;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="description-font fw-bold">🎉 Thank You for Your Booking!</h1>
        <div class="detail"><span class="label fw-bold">Name:</span> <span class="value"><?= htmlspecialchars($booking['name']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Mobile:</span> <span class="value"><?= htmlspecialchars($booking['mobile']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Address:</span> <span class="value"><?= htmlspecialchars($booking['address']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Check-in:</span> <span class="value"><?= htmlspecialchars($booking['check_in']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Check-out:</span> <span class="value"><?= htmlspecialchars($booking['check_out']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Total Persons:</span> <span class="value"><?= htmlspecialchars($booking['total_person']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Veg Meals:</span> <span class="value"><?= htmlspecialchars($booking['veg']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Non-Veg Meals:</span> <span class="value"><?= htmlspecialchars($booking['non_veg']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Total Amount:</span> <span class="value">₹<?= htmlspecialchars($booking['total_amount']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Advance Paid:</span> <span class="value">₹<?= htmlspecialchars($booking['advance']) ?></span></div>
        <div class="detail"><span class="label fw-bold">Balance:</span> <span class="value">₹<?= htmlspecialchars($booking['balance']) ?></span></div>
        <div class="text-center fw-bold">Please take a Screenshot of this page, it will be required during check-in.</div>
    </div>
    
</body>
</html>
