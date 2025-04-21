<?php
require('Includes/db_Configuration.php');
require('Includes/essentials.php');

session_start();
if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
    redirect('dashboard.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('Includes/links.php') ?>
    <style>
        .loginForm {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="loginForm text-center rounded text-center overflow-hidden shadow">
        <form method="POST">
            <h5 class="section text-white py-3">ADMIN LOGIN PANEL</h5>
            <div class="p-4">
                <div class="mb-4">
                    <input name="adminName" required type="text" class="form-control shadow-none text-center"
                        placeholder="Admin name">
                </div>
                <div class="mb-4">
                    <input name="adminPass" required type="password" class="form-control shadow-none text-center"
                        placeholder="password">
                </div>
                <div class="mb-4">
                    <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
                </div>
            </div>
        </form>
    </div>

    <?php


    if (isset($_POST['login'])) {
        $frm_data = filter($_POST);
        
        $query = "SELECT * FROM `admin_data` WHERE `adminName`=? AND `adminPass`=?";
        $values = [$frm_data['adminName'], $frm_data['adminPass']];

        $res = select($query, $values, "ss");
        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['Sr.no.'];
            redirect('dashboard.php');
        } else {
            alert('error', 'Login failed - Invalid Credentials!');
        }
    }


    ?>



    <?php require('Includes/scripts.php') ?>

</body>

</html>