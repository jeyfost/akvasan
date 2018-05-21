<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 21.05.2018
 * Time: 10:58
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);
$name = $mysqli->real_escape_string($_POST['name']);
$url = $mysqli->real_escape_string($_POST['url']);

$name = mb_strtolower($name);
$name = mb_strtoupper(mb_substr($name, 0, 1)).mb_substr($name, 1);

$categoryCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_categories WHERE name = '".$name."' AND id <> '".$id."'");
$categoryCheck = $categoryCheckResult->fetch_array(MYSQLI_NUM);

if($categoryCheck[0] == 0) {
    $urlCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_categories WHERE url = '".$url."' AND id <> '".$id."'");
    $urlCheck = $urlCheckResult->fetch_array(MYSQLI_NUM);

    if($urlCheck[0] == 0) {
        if($mysqli->query("UPDATE akvasan_categories SET name = '".$name."', url = '".$url."' WHERE id = '".$id."'")) {
            echo "ok";
        } else {
            echo "failed";
        }
    } else {
        echo "url duplicate";
    }
} else {
    echo "duplicate";
}