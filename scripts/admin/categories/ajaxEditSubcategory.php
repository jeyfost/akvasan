<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 21.05.2018
 * Time: 11:06
 */

include("../../connect.php");

$categoryId = $mysqli->real_escape_string($_POST['category']);
$subcategoryId = $mysqli->real_escape_string($_POST['subcategory']);
$name = $mysqli->real_escape_string($_POST['name']);
$url = $mysqli->real_escape_string($_POST['url']);

$name = mb_strtolower($name);
$name = mb_strtoupper(mb_substr($name, 0, 1)).mb_substr($name, 1);

$subcategoryCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_subcategories WHERE name = '".$name."' AND id <> '".$subcategoryId."' AND category_id = '".$categoryId."'");
$subcategoryCheck = $subcategoryCheckResult->fetch_array(MYSQLI_NUM);

if($subcategoryCheck[0] == 0) {
    if(!is_numeric($url)) {
        $urlCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_subcategories WHERE id <> '".$subcategoryId."' AND url = '".$url."'");
        $urlCheck = $urlCheckResult->fetch_array(MYSQLI_NUM);

        if($urlCheck[0] == 0) {
            if($mysqli->query("UPDATE akvasan_subcategories SET name = '".$name."', url = '".$url."' WHERE id = '".$subcategoryId."'")) {
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
    echo "duplicate";
}