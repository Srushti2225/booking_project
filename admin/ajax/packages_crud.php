<?php
require('../Includes/db_Configuration.php');
require('../Includes/essentials.php');
adminLogin();

if(isset($_POST['add_package']))
    {
        $frm_data = filter($_POST);
        $img_r = uploadImage($_FILES['image'], PACKAGE_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            $q = "INSERT INTO `packages`(`image`, `name`, `price`, `inclusions`, `addons`, `check_in`, `check_out`) VALUES (?,?,?,?,?,?,?)";
            $values = [$img_r,$frm_data['name'],$frm_data['price'],$frm_data['inclusions'],$frm_data['addons'],$frm_data['check_in'],$frm_data['check_out']];
            $res = insert($q, $values, 'ssissss');
            //echo $res;
            if($res == 1){
                echo 1;
            } else {
                echo "insert_failed";
            }
                

        }
    }




if(isset($_POST['get_packages']))
    {
        $res = selectAll('packages');
        $i=1;
        $path = PACKAGE_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['status']==1)
            {
                $status = "<button onclick=toggle_status($row[id],0) class='btn custom-bg btn-sm shadow-none text-white'>Active</button>";
            }
            else{
                $status = "<button onclick=toggle_status($row[id],1) class='btn btn-danger btn-sm shadow-none'>Inactive</button>";

            }
            echo <<<data
                <tr>
                    <td>$i</td>
                    <td><img src="$path$row[image]" width="30px"></td>
                    <td>$row[name]</td>
                    <td>₹$row[price]</td>
                    <td>$row[inclusions]</td>
                    <td>$row[addons]</td>
                    <td>$row[check_in]</td>
                    <td>$row[check_out]</td>
                    <td>$status</td>
                    <td>
                        <button type="button" onclick="rem_package($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                        
                    </td>
                </tr>
                data;
                $i++;

        }
    }
    if(isset($_POST['rem_package']))
    {
        $frm_data = filter($_POST);
        $values = [$frm_data['rem_package']];

        $pre_q = "SELECT * FROM `packages` WHERE `id`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['image'],PACKAGE_FOLDER)){
        $q = "DELETE FROM `packages` WHERE `id`=?";
        $res = deleteRow($q,$values,'i');
        echo $res;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['toggle_status']))
    {
        $frm_data = filter($_POST);

        $q = "UPDATE `packages` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['toggle_status']];

        if(update($q,$v,'ii')){
            echo 1;
        }
        else{
            echo 0;
        }
    }



?>
