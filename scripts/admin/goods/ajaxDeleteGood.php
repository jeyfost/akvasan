<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 24.05.2018
 * Time: 13:17
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$goodResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE id = '".$id."'");
$good = $goodResult->fetch_assoc();

if($mysqli->query("DELETE FROM akvasan_catalogue WHERE id = '".$id."'")) {
    unlink("../../../img/catalogue/preview/".$good['preview']);
    unlink("../../../img/catalogue/big/".$good['photo']);

    $mysqli->query("DELETE FROM akvasan_good_properties WHERE good_id = '".$id."'");

    $photoResult = $mysqli->query("SELECT * FROM akvasan_photos WHERE good_id = '".$id."'");
    while($photo = $photoResult->fetch_assoc()) {
        if($mysqli->query("DELETE FROM akvasan_photos WHERE id = '".$photo['id']."'")) {
            unlink("../../../img/catalogue/all/".$photo['photo']);
        }
    }

    echo "ok";
} else {
    echo "failed";
}