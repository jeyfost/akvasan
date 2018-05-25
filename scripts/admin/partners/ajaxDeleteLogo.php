<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 25.05.2018
 * Time: 11:15
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$logoResult = $mysqli->query("SELECT * FROM akvasan_partners WHERE id = '".$id."'");
$logo = $logoResult->fetch_assoc();

if($mysqli->query("DELETE FROM akvasan_partners WHERE id = '".$id."'")) {
    unlink("../../../img/partners/".$logo['img']);

    echo "ok";
} else {
    echo "failed";
}