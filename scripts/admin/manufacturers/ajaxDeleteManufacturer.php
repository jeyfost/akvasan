<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 14.06.2018
 * Time: 17:36
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$manufacturerResult = $mysqli->query("SELECT * FROM akvasan_manufacturers WHERE id = '".$id."'");
$manufacturer = $manufacturerResult->fetch_assoc();

if($mysqli->query("DELETE FROM akvasan_manufacturers WHERE id = '".$id."'")) {
    $manufacturerCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue WHERE manufacturer = '".$manufacturer['id']."'");

    if($manufacturerCheckResult->num_rows > 0) {
        $mysqli->query("UPDATE akvasan_catalogue SET manufacturer = '0' WHERE manufacturer = '".$manufacturer['id']."'");
    }

    echo "ok";
} else {
    echo "failed";
}