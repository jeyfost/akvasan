<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 24.05.2018
 * Time: 11:56
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$photoResult = $mysqli->query("SELECT * FROM akvasan_photos WHERE id = '".$id."'");
$photo = $photoResult->fetch_assoc();

if($mysqli->query("DELETE FROM akvasan_photos WHERE id = '".$id."'")) {
    unlink("../../../img/catalogue/all/".$photo['photo']);

    echo "ok";
} else {
    echo "failed";
}