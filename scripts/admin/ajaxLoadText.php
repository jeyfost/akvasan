<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 17.05.2018
 * Time: 17:09
 */

include("../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$textResult = $mysqli->query("SELECT text FROM akvasan_text WHERE id = '".$id."'");
$text = $textResult->fetch_array(MYSQLI_NUM);

echo $text[0];