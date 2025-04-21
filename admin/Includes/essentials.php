<?php


//frontend purpose data
define('SITE_URL','http://127.0.0.1/Booking_project/');
define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');
define('PACKAGE_IMG_PATH',SITE_URL.'images/rooms/');


//backend upload process needs this data
define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/Booking_project/images/');
define('ABOUT_FOLDER','about/');
define('CAROUSEL_FOLDER','carousel/');
define('PACKAGE_FOLDER','rooms/');







function adminLogin(){
    session_start();
    if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
        echo"<script>
        window.location.href='index.php';
        </script>";
        exit;
    }
}


function redirect($url){
    echo"<script>
        window.location.href = '$url';
        </script>";
        exit;
}

function alert($type, $message){
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
    <div class="alert $bs_class alert-warning alert-dismissible fade show custom-alert" role="alert">
        <strong class="me-3">$message</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    alert;

}

function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } else if (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        $original_name = pathinfo($image['name'], PATHINFO_FILENAME);
        $rname = $original_name . '.' . $ext; // Keep original name, e.g., img7.jpg

        // Check for file conflicts
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
        $counter = 1;
        while (file_exists($img_path)) {
            $rname = $original_name . '_' . $counter . '.' . $ext; // Append _1, _2, etc.
            $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
            $counter++;
        }

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname; // Return original or adjusted name
        } else {
            return 'upd_failed';
        }
    }
}

function deleteImage($image, $folder){
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
        return true;
    }
    else{
        return false;
    }
}
?>