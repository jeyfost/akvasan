<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 25.05.2018
 * Time: 10:27
 */

include("../../connect.php");
include("../../image.php");

$req = false;
ob_start();

$start = 0;
$finish = 0;
$errors = 0;

foreach ($_FILES['logo']['error'] as $key => $error) {
    if(!empty($_FILES['logo']['tmp_name'][$key])) {
        if($error != UPLOAD_ERR_OK or substr($_FILES['logo']['type'][$key], 0, 5) != "image") {
            $errors++;
        }
    }
}

if($errors == 0) {
    foreach ($_FILES['logo']['error'] as $key => $error) {
        if($error == UPLOAD_ERR_OK) {
            $photoTmpName = $_FILES['logo']['tmp_name'][$key];
            $photoName = randomName($photoTmpName);
            $photoDBName = $photoName.".".substr($_FILES['logo']['name'][$key], count($_FILES['logo']['name'][$key]) - 4, 4);
            $photoUploadDir = "../../../img/partners/";
            $photoUpload = $photoUploadDir.$photoDBName;

            $start++;

            if($mysqli->query("INSERT INTO akvasan_partners (img) VALUES ('".$photoDBName."')")) {
                resize($photoTmpName, false, 30);
                move_uploaded_file($photoTmpName, $photoUpload);

                $finish++;
            }
        } else {
            $errors++;
        }
    }

    if($finish == 0) {
        echo "failed";
    } else {
        if($start == $finish) {
            echo "ok";
        } else {
            echo "partly";
        }
    }
} else {
    echo "photo";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;