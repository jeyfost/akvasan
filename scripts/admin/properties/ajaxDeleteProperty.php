<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 18.05.2018
 * Time: 15:25
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$propertyResult = $mysqli->query("SELECT * FROM akvasan_properties WHERE id = '".$id."'");
$property = $propertyResult->fetch_assoc();

if($mysqli->query("DELETE FROM akvasan_properties WHERE id = '".$id."'")) {
    $propertyCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_good_properties WHERE property_id = '".$property['id']."'");

    if($propertyCheckResult->num_rows > 0) {
        $mysqli->query("DELETE FROM akvasan_good_properties WHERE property_id = '".$property['id']."'");
    }

    echo "ok";
} else {
    echo "failed";
}