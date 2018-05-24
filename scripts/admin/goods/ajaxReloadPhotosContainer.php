<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 24.05.2018
 * Time: 11:59
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$photoResult = $mysqli->query("SELECT * FROM akvasan_photos WHERE good_id = '".$id."'");
while($photo = $photoResult->fetch_assoc()) {
    echo "
        <div class='goodPhoto'>
            <a href='/img/catalogue/all/".$photo['photo']."' class='lightview' data-lightview-options='skin: \"light\"' data-lightview-group='photos'><img src='/img/catalogue/all/".$photo['photo']."' /></a>
		    <br />
		    <span onclick='deleteGoodPhoto(\"".$photo['id']."\", \"".$id."\")' class='photoLink'>Удалить</span>
        </div>
    ";
}