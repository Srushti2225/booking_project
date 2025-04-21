<?php
session_start();
require('admin/Includes/db_Configuration.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = filter($_POST);
    $room = $_SESSION['room'];

    // File upload handling
    if (isset($_FILES['payment_screenshot'])) {
        $targetDir = "uploads/payments/"; // Directory where the file will be saved
        $fileName = time() . "_" . $_FILES['payment_screenshot']['name']; // Rename file to avoid conflicts
        $targetFilePath = $targetDir . $fileName;

        // Check if directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES['payment_screenshot']['tmp_name'], $targetFilePath)) {
            echo "File uploaded successfully.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    // Insert data into bookings table
    $query = "INSERT INTO bookings 
(package_id, name, mobile, address, check_in, check_out, adults, kids_0_5, kids_5_10, girls, boys, total_person, veg, non_veg, total_amount, advance, balance, payment_status, payment_screenshot, added_on)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    
    // File path to store in DB
    $paymentScreenshot = isset($targetFilePath) ? $targetFilePath : null;

    $values = [
        $room['id'],
        $data['name'],
        $data['mobile'],
        $data['address'],
        $data['checkin'],
        $data['checkout'],
        $data['adults'],
        $data['kids_0_5'],
        $data['kids_5_10'],
        $data['girls'],
        $data['boys'],
        $data['total_person'],
        $data['veg'],
        $data['non_veg'],
        $data['total_amount'],
        $data['advance'],
        $data['balance'],
        'pending',
        $paymentScreenshot // Storing file path
    ];

    if (insert($query, $values, 'isssssiiiiiiiidddss')) {
        $booking_id = mysqli_insert_id($con); // Make sure $con is your DB connection
        $_SESSION['booking_id'] = $booking_id;
        header('Location: thank_you.php');
        exit;
    }
}
?>
