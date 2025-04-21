<?php
require('../Includes/db_configuration.php');
require('../Includes/essentials.php');
adminLogin();

if(isset($_POST['add_facility']))
    {
        $frm_data = filter($_POST);
        $img_r = uploadImage($_FILES['icon'], ABOUT_FOLDER);

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
            $q = "INSERT INTO `facilities`(`icon`,`name`,`description`) VALUES (?,?,?)";
            $values = [$img_r,$frm_data['name'],$frm_data['description']];
            $res = insert($q, $values, 'sss');
            //echo $res;
            if($res == 1){
                echo 1;
            } else {
                echo "insert_failed";
            }
                

        }
}

if(isset($_POST['get_facilities']))
    {
        $res = selectAll('facilities');
        $i=1;
        $path = ABOUT_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
                <tr>
                    <td>$i</td>
                    <td><img src="$path$row[icon]" width="30px"></td>
                    <td>$row[name]</td>
                    <td>$row[description]</td>
                    <td>
                        <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                data;
                $i++;

        }
}
if(isset($_POST['rem_facility']))
    {
        $frm_data = filter($_POST);
        $values = [$frm_data['rem_facility']];

        $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['icon'],ABOUT_FOLDER)){
        $q = "DELETE FROM `facilities` WHERE `id`=?";
        $res = deleteRow($q,$values,'i');
        echo $res;
        }
        else{
            echo 0;
        }

        
}

// if (isset($_POST['add_section'])) {
//     $frm_data = filter($_POST);

//     if (!isset($frm_data['about_section_title']) || !isset($frm_data['about_section_description'])) {
//         echo "missing_fields";
//         exit;
//     }

//     $q = "INSERT INTO `about_section`(`section_name`, `content`) VALUES (?, ?)";
//     $values = [$frm_data['about_section_title'], $frm_data['about_section_description']];
//     $res = insert($q, $values, 'ss');
//     echo ($res == 1) ? 1 : "insert_failed";
// }


// if (isset($_POST['get_sections'])) {
//     $res = selectAll('about_section');
//     if ($res === false) {
//         echo "Query failed";
//     } else {
//         $data = '';
//         while ($row = mysqli_fetch_assoc($res)) {
//             $data .= <<<data
//                 <tr>
//                     <td>$row[section_name]</td>
//                     <td>$row[content]</td>
//                     <td>
//                         <button type="button" onclick="update_section($row[id])" class="btn btn-primary btn-sm shadow-none">
//                             <i class="bi bi-pencil-square"></i> Edit
//                         </button>
//                         <button type="button" onclick="rem_section($row[id])" class="btn btn-danger btn-sm shadow-none ms-2">
//                             <i class="bi bi-trash"></i> Delete
//                         </button>
//                     </td>
//                 </tr>
//             data;
//         }
//         echo $data;
//     }
// }

// if (isset($_POST['update_section'])) {
//     $frm_data = filter($_POST);
//     $q = "UPDATE about_section SET `content`=? WHERE `id` = ?";
//     $values = [$frm_data['content'], $frm_data['section_id']];
//     $res = update($q, $values, 'si');
//     if ($res > 0) {
//         error_log("Updated section: $frm_data[section_id]");
//         echo 1;
//     } else {
//         echo "update_failed";
//     }
// }

// if (isset($_POST['rem_section'])) {
//     $frm_data = filter($_POST);
//     $section_id = $frm_data['section_id'];
//     $q = "DELETE FROM `about_section` WHERE `id`=?";
//     $values = [$section_id];
//     $res = deleteRow($q, $values, 'i');
//     echo $res;
// }



?>