<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 22.05.2018
 * Time: 12:14
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);
$name = $mysqli->real_escape_string($_POST['name']);
$url = $mysqli->real_escape_string($_POST['url']);

$name = mb_strtolower($name);
$name = mb_strtoupper(mb_substr($name, 0, 1)).mb_substr($name, 1);

$nameCheckResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE name = '".$name."' AND category_id = '".$id."'");
$nameCheck = $nameCheckResult->fetch_array(MYSQLI_NUM);

if($nameCheck[0] == 0) {
    if(!is_numeric($url)) {
        $urlCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_subcategories WHERE url = '".$url."'");
        $urlCheck = $urlCheckResult->fetch_assoc();

        if($urlCheck[0] == 0) {
            if($mysqli->query("INSERT INTO akvasan_subcategories (category_id, name, url) VALUES ('".$id."', '".$name."', '".$url."')")) {
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
    echo "name duplicate";
}