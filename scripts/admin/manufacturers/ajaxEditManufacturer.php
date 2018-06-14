<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 14.06.2018
 * Time: 17:28
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);
$name = $mysqli->real_escape_string($_POST['name']);

$name = mb_strtolower($name);
$name = mb_strtoupper(mb_substr($name, 0, 1)).mb_substr($name, 1);

$nameCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_manufacturers WHERE name = '".$name."' AND id <> '".$id."'");
$nameCheck = $nameCheckResult->fetch_array(MYSQLI_NUM);

if($nameCheck[0] == 0) {
    if($mysqli->query("UPDATE akvasan_manufacturers SET name = '".$name."' WHERE id = '".$id."'")) {
        echo "ok";
    } else {
        echo "failed";
    }
} else {
    echo "duplicate";
}