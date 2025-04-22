<?php

require('../Includes/db_Configuration.php');
require('../Includes/essentials.php');
adminLogin();

    //general settings
    if(isset($_POST['get_general']))
    {
        $q = "SELECT * FROM `settings` WHERE `Sr.no.`=?";
        $values = [1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_general']))
    {
        $frm_data = filter($_POST);

        $q = "UPDATE `settings` SET `site_title`=?,`site_about`=? WHERE `Sr.no.`=?";
        $values = [$frm_data['site_title'],$frm_data['site_about'],1];
        $res = update($q, $values, 'ssi');
        if ($res === 0) {
            echo 'no_changes'; // Indicate no rows were affected
        } else if ($res > 0) {
            echo 1; // Indicate success
        } else {
            echo 'error'; // Indicate a failure
        }
    
    }

    if(isset($_POST['upd_shutdown']))
    {
        $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;

        $q = "UPDATE `settings` SET `shutdown`=? WHERE `Sr.no.`=?";
        $values = [$frm_data,1];
        $res = update($q, $values, 'ii');
        echo $res;
        
    
    }

    //contact details settings
    if(isset($_POST['get_contacts']))
    {
        header('Content-Type: application/json');
        $q = "SELECT * FROM `contact_settings` WHERE `Sr.no.`=?";
        $values = [1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_contacts']))
    {
        $frm_data = filter($_POST);

        $q = "UPDATE `contact_settings` SET `address`=?,`gMap`=?,`pn`=?,`email`=?,`insta`=?,`iframe`=? WHERE `Sr.no.`=?";
        $values = [$frm_data['address'],$frm_data['gMap'],$frm_data['pn'],$frm_data['email'],$frm_data['insta'],$frm_data['iframe'],1];
        $res = update($q, $values, 'ssssssi');
        echo $res;
    
    }



?>
