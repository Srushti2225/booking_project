<?php
require('../Includes/db_configuration.php');
require('../Includes/essentials.php');
adminLogin();

if (isset($_POST['get_bookings'])) {
    $res = selectAll('bookings');
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {
        $total = number_format($row['total_amount'], 2);
        $advance = number_format($row['advance'], 2);
        $balance = number_format($row['balance'], 2);
        $payment_status = $row['payment_status'];
        $screenshot_link = '../' . $row['payment_screenshot']; // Create full path
        $i++;
    
        echo <<<data
        <tr>
            <td>$i</td>
            <td>{$row['package_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['mobile']}</td>
            <td>{$row['address']}</td>
            <td>{$row['check_in']}</td>
            <td>{$row['check_out']}</td>
            <td>{$row['adults']}</td>
            <td>{$row['kids_0_5']}</td>
            <td>{$row['kids_5_10']}</td>
            <td>{$row['girls']}</td>
            <td>{$row['boys']}</td>
            <td>{$row['veg']}</td>
            <td>{$row['non_veg']}</td>
            <td>₹$total</td>
            <td>₹$advance</td>
            <td>₹$balance</td>
            <td><a href="$screenshot_link" target="_blank">View</a></td>
            <td>
                <button type="button" onclick="rem_booking({$row['id']})" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </td>
        </tr>
        data;
    }
    
}

if (isset($_POST['rem_booking'])) {
    $frm_data = filter($_POST);
    $values = [$frm_data['rem_booking']];
    $query = "DELETE FROM `bookings` WHERE `id`=?";
    $res = deleteRow($query, $values, 'i');
    echo $res;
}
?>
