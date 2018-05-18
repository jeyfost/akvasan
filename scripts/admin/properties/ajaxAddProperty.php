<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 18.05.2018
 * Time: 15:07
 */

include("../../connect.php");

$name = $mysqli->real_escape_string($_POST['name']);

$name = mb_strtolower($name);
$name = mb_strtoupper(mb_substr($name, 0, 1)).mb_substr($name, 1);

$nameCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_properties WHERE name = '".$name."' AND id <> '".$id."'");
$nameCheck = $nameCheckResult->fetch_array(MYSQLI_NUM);

if($nameCheck[0] == 0) {
    if($mysqli->query("INSERT INTO akvasan_properties (name) VALUES ('".$name."')")) {
        echo "ok";
    } else {
        echo "failed";
    }
} else {
    echo "duplicate";
}