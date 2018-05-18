<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 18.05.2018
 * Time: 12:06
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);
$name = $mysqli->real_escape_string($_POST['name']);
$text = $mysqli->real_escape_string(nl2br($_POST['text']));

if($mysqli->query("UPDATE akvasan_reviews SET name = '".$name."', text = '".$text."' WHERE id = '".$id."'")) {
    echo "ok";
} else {
    echo "failed";
}