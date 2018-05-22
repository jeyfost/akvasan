<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 21.05.2018
 * Time: 17:59
 */

include("../../connect.php");

$name = $mysqli->real_escape_string($_POST['name']);
$url = $mysqli->real_escape_string($_POST['url']);

$name = mb_strtolower($name);
$name = mb_strtoupper(mb_substr($name, 0, 1)).mb_substr($name, 1);

$nameCheckResult = $mysqli->query("SELECT * FROM akvasan_categories WHERE name = '".$name."'");
$nameCheck = $nameCheckResult->fetch_array(MYSQLI_NUM);

if($nameCheck[0] == 0) {
    if(!is_numeric($url)) {
        $urlCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_categories WHERE url = '".$url."'");
        $urlCheck = $urlCheckResult->fetch_assoc();

        if($urlCheck[0] == 0) {
            if($mysqli->query("INSERT INTO akvasan_categories (name, url) VALUES ('".$name."', '".$url."')")) {
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