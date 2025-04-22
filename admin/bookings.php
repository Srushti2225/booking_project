<?php
require('Includes/db_Configuration.php');
require('Includes/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bookings</title>
    <?php require('Includes/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('Includes/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <h3 class="mb-4">Bookings</h3>

                <div class="table-responsive-lg" style="height: 600px; overflow-y: scroll;">
                    <table class="table table-hover border text-center">
                        <thead class="sticky-top bg-dark text-light">
                            <tr class="custom-bg text-white text-center">
                                <th>#</th>
                                <th>Booking ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Adults</th>
                                <th>Kids (0-5)</th>
                                <th>Kids (5-10)</th>
                                <th>Girls</th>
                                <th>Boys</th>
                                <th>Veg</th>
                                <th>Non-Veg</th>
                                <th>Total</th>
                                <th>Advance</th>
                                <th>Balance</th>
                                <th>Screenshot</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="bookings-data">
                            <!-- Data loaded via JS -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <?php require('Includes/scripts.php'); ?>

    <script>
        function get_bookings() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/bookings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('bookings-data').innerHTML = this.responseText;
            }

            xhr.send('get_bookings');
        }

        function rem_booking(id) {
            if (confirm("Are you sure you want to delete this booking?")) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/bookings_crud.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {
                    if (this.responseText == 1) {
                        alert('success', 'Booking deleted!');
                        get_bookings();
                    } else {
                        alert('error', 'Failed to delete booking.');
                    }
                }

                xhr.send('rem_booking=' + id);
            }
        }

        // Load bookings on page load
        window.onload = get_bookings;
    </script>

</body>

</html>
