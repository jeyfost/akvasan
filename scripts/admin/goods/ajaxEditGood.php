<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 22.05.2018
 * Time: 17:21
 */

include("../../connect.php");
include("../../image.php");

$req = false;
ob_start();

$categoryID = $mysqli->real_escape_string($_POST['category']);
$subcategoryID = $mysqli->real_escape_string($_POST['subcategory']);
$manufacturer = $mysqli->real_escape_string($_POST['manufacturer']);
$goodID = $mysqli->real_escape_string($_POST['good']);
$name = $mysqli->real_escape_string($_POST['name']);
$url = $mysqli->real_escape_string($_POST['url']);
$price = $mysqli->real_escape_string($_POST['price']);
$code = $mysqli->real_escape_string($_POST['code']);
$leader = $mysqli->real_escape_string($_POST['leader']);
$text = $mysqli->real_escape_string($_POST['text']);
$propertyID = explode(",", $_POST['propertyID']);
$propertyValue = explode(",", $_POST['propertyValue']);

if($leader == "on") {
    $leader = 1;
} else {
    $leader = 0;
}

if(empty($manufacturer)) {
    $manufacturer = 0;
}

$nameCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue WHERE name = '".$name."' AND subcategory = '".$subcategoryID."' AND id <> '".$goodID."'");
$nameCheck = $nameCheckResult->fetch_array(MYSQLI_NUM);

$goodResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE id = '".$goodID."'");
$good = $goodResult->fetch_assoc();

if($nameCheck[0] == 0) {
    $codeCheckResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE code = '".$code."' AND id <> '".$goodID."'");
    $codeCheck = $codeCheckResult->fetch_array(MYSQLI_NUM);

    if($codeCheck[0] == 0) {
        if(!is_numeric($url)) {
            $url = str_replace(" ", "-", $url);
            $url = str_replace("_", "-", $url);

            $urlCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue WHERE url = '".$url."' AND id <> '".$goodID."'");
            $urlCheck = $urlCheckResult->fetch_array(MYSQLI_NUM);

            if($urlCheck[0] == 0) {
                if(!empty($_FILES['preview']['tmp_name'])) {
                    if($_FILES['preview']['error'] == 0 and substr($_FILES['preview']['type'], 0, 5) == "image") {
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

                        if($mysqli->query("UPDATE akvasan_catalogue SET photo = '".$photoDBName."', preview = '".$previewDBName."' WHERE id = '".$goodID."'")) {
                            unlink($previewUploadDir.$good['preview']);
                            unlink($photoUploadDir.$good['photo']);

                            copy($photoTmpName, $photoUpload);

                            resize($previewTmpName, 175);
                            move_uploaded_file($previewTmpName, $previewUpload);
                        } else {
                            echo "preview upload";

                            $req = ob_get_contents();
                            ob_end_clean();
                            echo json_encode($req);

                            exit;
                        }
                    } else {
                        echo "preview";

                        $req = ob_get_contents();
                        ob_end_clean();
                        echo json_encode($req);

                        exit;
                    }
                }

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

                            if($mysqli->query("INSERT INTO akvasan_photos (good_id, photo) VALUES ('".$goodID."', '".$photoDBName."')")) {
                                copy($photoTmpName, $photoUpload);
                                $finish++;
                            }
                        } else {
                            $errors++;
                        }
                    }

                    if($start != $finish) {
                        echo "photos upload";

                        $req = ob_get_contents();
                        ob_end_clean();
                        echo json_encode($req);

                        exit;
                    }
                } else {
                    echo "photos";

                    $req = ob_get_contents();
                    ob_end_clean();
                    echo json_encode($req);

                    exit;
                }

                if($mysqli->query("UPDATE akvasan_catalogue SET name = '".$name."', description = '".$text."', price = '".$price."', code = '".$code."', leader = '".$leader."', url = '".$url."', manufacturer = '".$manufacturer."' WHERE id = '".$goodID."'")) {
                    $mysqli->query("DELETE FROM akvasan_good_properties WHERE good_id = '".$goodID."'");

                    for($i = 0; $i < count($propertyID); $i++) {
                        $mysqli->query("INSERT INTO akvasan_good_properties (property_id, good_id, value) VALUES ('".$propertyID[$i]."', '".$goodID."', '".$propertyValue[$i]."')");
                    }

                    echo "ok";
                } else {
                    echo "failed";
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