<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 16.05.2018
 * Time: 20:00
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);
$title = $mysqli->real_escape_string($_POST['title']);
$keywords = $mysqli->real_escape_string($_POST['keywords']);
$description = $mysqli->real_escape_string($_POST['description']);

if(substr($keywords, strlen($keywords) - 1, 1) == ",") {
    $keywords = substr($keywords, 0, strlen($keywords) - 1);
}

if($mysqli->query("UPDATE akvasan_pages SET title = '".$title."', keywords = '".$keywords."', description = '".$description."' WHERE id = '".$id."'")) {
    echo "ok";
} else {
    echo "failed";
}