<?php
session_start();
require('admin/Includes/db_Configuration.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect('packages.php');
}

$data = filter($_GET);

// Fetch package
$room_res = select("SELECT * FROM `packages` WHERE `id`=? AND `status`=?", [$data['id'], 1], 'ii');
if (mysqli_num_rows($room_res) == 0) {
    echo "No package found!";
    exit;
}

$room_data = mysqli_fetch_assoc($room_res);
$_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "price" => $room_data['price'],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Confirm Booking - <?php echo $room_data['name']; ?></title>
    <?php require('IncludeFiles/links.php'); ?>
</head>

<body class="bg-light">
    <?php require('IncludeFiles/header.php'); ?>

    <div class="container mt-5 mb-5">
        <h2 class="mb-4 description-font">Booking - <?php echo $room_data['name']; ?>
            (₹<?php echo $room_data['price']; ?>/person)</h2>

        <form action="booking_handler.php" method="POST" id="bookingForm" enctype="multipart/form-data">
            <input type="hidden" id="price_per_person" value="<?php echo $room_data['price']; ?>">

            <div class="row">
                <div class="col-md-6">
                    <label>Check-in Date</label>
                    <input type="date" name="checkin" id="checkin" class="form-control" onchange="calculateTotal()"
                        required>
                </div>
                <div class="col-md-6">
                    <label>Check-out Date</label>
                    <input type="date" name="checkout" id="checkout" class="form-control" onchange="calculateTotal()"
                        required>
                </div>
                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Mobile/WhatsApp Number</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label>Address</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>

                <div class="col-md-4">
                    <label>No. of Adults</label>
                    <input type="number" name="adults" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>No. of Kids (0-5)</label>
                    <input type="number" name="kids_0_5" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>No. of Kids (5-10)</label>
                    <input type="number" name="kids_5_10" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>No. of Female</label>
                    <input type="number" name="girls" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>No. of Male</label>
                    <input type="number" name="boys" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Total Persons</label>
                    <input type="number" name="total_person" id="total_person" class="form-control"
                        oninput="calculateTotal()" required>
                </div>

                <div class="col-md-6">
                    <label>Veg Count</label>
                    <input type="number" name="veg" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Non-Veg Count</label>
                    <input type="number" name="non_veg" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Total Amount (₹)</label>
                    <input type="text" name="total_amount" id="total_amount" class="form-control" readonly required>
                </div>
                <div class="col-md-4">
                    <label>Advance (₹)</label>
                    <input type="number" name="advance" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Balance (₹)</label>
                    <input type="number" name="balance" class="form-control" required>
                </div>

                <div class="col-md-12 mt-4 text-center">
                    <label class="fw-bold mb-2">Scan to Pay via UPI</label><br>
                    <img src="images/QR.jpg" alt="Scan QR to Pay" width="250" height="auto" class="border rounded">
                    <p class="mt-2 text-muted">Please scan this QR code and complete the payment. Then upload the
                        screenshot below.</p>
                </div>
                <div class="col-md-12 mt-3">
                    <label>Upload Payment Screenshot (jpg, png)</label>
                    <input type="file" name="payment_screenshot" class="form-control" accept="image/png, image/jpeg"
                        required>
                </div>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn custom-bg text-white">Confirm Booking</button>
            </div>
        </form>
    </div>

    <?php require('IncludeFiles/footer.php'); ?>

    <script>
        function calculateTotal() {
            let price = parseFloat(document.getElementById("price_per_person").value);
            let persons = parseInt(document.getElementById("total_person").value);
            let checkin = new Date(document.getElementById("checkin").value);
            let checkout = new Date(document.getElementById("checkout").value);

            let diffTime = checkout - checkin;
            let days = diffTime / (1000 * 60 * 60 * 24);
            if (isNaN(days) || days < 1) days = 1;

            let total = price * persons * days;
            document.getElementById("total_amount").value = total.toFixed(2);
        }
    </script>

</body>

</html>