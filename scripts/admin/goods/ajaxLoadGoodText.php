<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 22.05.2018
 * Time: 17:01
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$textResult = $mysqli->query("SELECT description FROM akvasan_catalogue WHERE id = '".$id."'");
$text = $textResult->fetch_array(MYSQLI_NUM);

echo $text[0];