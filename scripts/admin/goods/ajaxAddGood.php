<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 24.05.2018
 * Time: 15:55
 */

include("../../connect.php");
include("../../image.php");

$req = false;
ob_start();

$categoryID = $mysqli->real_escape_string($_POST['category']);
$subcategoryID = $mysqli->real_escape_string($_POST['subcategory']);
$name = $mysqli->real_escape_string($_POST['name']);
$url = $mysqli->real_escape_string($_POST['url']);
$price = $mysqli->real_escape_string($_POST['price']);
$code = $mysqli->real_escape_string($_POST['code']);
$leader = $mysqli->real_escape_string($_POST['leader']);
$text = $mysqli->real_escape_string($_POST['text']);
$propertyID = explode(",", $_POST['propertyID']);
$propertyValue = explode(",", $_POST['propertyValue']);

$maxIDResult = $mysqli->query("SELECT MAX(id) FROM akvasan_catalogue");
$maxID = $maxIDResult->fetch_array(MYSQLI_NUM);

$id = $maxID[0] + 1;

if($leader == "on") {
    $leader = 1;
} else {
    $leader = 0;
}

$nameCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue WHERE name = '".$name."' AND subcategory = '".$subcategoryID."'");
$nameCheck = $nameCheckResult->fetch_array(MYSQLI_NUM);

if($nameCheck[0] == 0) {
    $codeCheckResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE code = '".$code."'");
    $codeCheck = $codeCheckResult->fetch_array(MYSQLI_NUM);

    if($codeCheck[0] == 0) {
        if (!is_numeric($url)) {
            $url = str_replace(" ", "-", $url);
            $url = str_replace("_", "-", $url);

            $urlCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue WHERE url = '".$url."'");
            $urlCheck = $urlCheckResult->fetch_array(MYSQLI_NUM);

            if($urlCheck[0] == 0) {
                if(!empty($_FILES['preview']['tmp_name'])) {
                    if($_FILES['preview']['error'] == 0 and substr($_FILES['preview']['type'], 0, 5) == "image") {
                        $start = 0;
                        $finish = 0;
                        $errors = 0;

                        foreach ($_FILES['additionalPhotos']['error'] as $key => $error) {
                            if(!empty($_FILES['additionalPhotos']['tmp_name'][$key])) {
                                if($error != UPLOAD_ERR_OK or substr($_FILES['additionalPhotos']['type'][$key], 0, 5) != "image") {
                                    $errors++;
                                }
                            }
                        }

                        if($errors == 0) {
                            foreach ($_FILES['additionalPhotos']['error'] as $key => $error) {
                                if($error == UPLOAD_ERR_OK) {
                                    $photoTmpName = $_FILES['additionalPhotos']['tmp_name'][$key];
                                    $photoName = randomName($photoTmpName);
                                    $photoDBName = $photoName.".".substr($_FILES['additionalPhotos']['name'][$key], count($_FILES['additionalPhotos']['name'][$key]) - 4, 4);
                                    $photoUploadDir = "../../../img/catalogue/all/";
                                    $photoUpload = $photoUploadDir.$photoDBName;

                                    $start++;

                                    if($mysqli->query("INSERT INTO akvasan_photos (good_id, photo) VALUES ('".$id."', '".$photoDBName."')")) {
                                        copy($photoTmpName, $photoUpload);
                                        $finish++;
                                    }
                                } else {
                                    $errors++;
                                }
                            }

                            if($start == $finish) {
                                $previewTmpName = $_FILES['preview']['tmp_name'];
                                $previewName = randomName($previewTmpName);
                                $previewDBName = $previewName.".".substr($_FILES['preview']['name'], count($_FILES['preview']['name']) - 4, 4);
                                $previewUploadDir = "../../../img/catalogue/preview/";
                                $previewUpload = $previewUploadDir.$previewDBName;

                                $photoTmpName = $_FILES['preview']['tmp_name'];
                                $photoName = randomName($photoTmpName);
                                $photoDBName = $photoName.".".substr($_FILES['preview']['name'], count($_FILES['preview']['name']) - 4, 4);
                                $photoUploadDir = "../../../img/catalogue/big/";
                                $photoUpload = $photoUploadDir.$photoDBName;

                                if($mysqli->query("INSERT INTO akvasan_catalogue (id, name, photo, preview, category, subcategory, description, price, code, url, date, leader) VALUES ('".$id."', '".$name."', '".$photoDBName."', '".$previewDBName."', '".$categoryID."', '".$subcategoryID."', '".$text."', '".$price."', '".$code."', '".$url."', '".date('Y-m-d H:i:s')."', '".$leader."')")) {
                                    for($i = 0; $i < count($propertyID); $i++) {
                                        $mysqli->query("INSERT INTO akvasan_good_properties (property_id, good_id, value) VALUES ('".$propertyID[$i]."', '".$id."', '".$propertyValue[$i]."')");
                                    }

                                    copy($photoTmpName, $photoUpload);

                                    resize($previewTmpName, 175);
                                    move_uploaded_file($previewTmpName, $previewUpload);

                                    echo "ok";
                                } else {
                                    echo "failed";
                                }
                            } else {
                                $photoResult = $mysqli->query("DELETE FROM akvasan_photos WHERE good_id = '".$id."'");

                                echo "photos upload";
                            }
                        } else {
                            echo "photos";
                        }
                    } else {
                        echo "preview";
                    }
                } else {
                    echo "photo";
                }
            } else {
                echo "url duplicate";
            }
        } else {
            echo "url format";
        }
    } else {
        echo "code";
    }
} else {
    echo "name duplicate";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;