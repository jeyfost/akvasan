<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 25.05.2018
 * Time: 11:17
 */

include("../../connect.php");

$logoResult = $mysqli->query("SELECT * FROM akvasan_partners");
while ($logo = $logoResult->fetch_assoc()) {
    echo "
        <div class='logo'>
            <a href='/img/partners/".$logo['img']."' class='lightview' data-lightview-options='skin: \"light\"' data-lightview-group='photos'><img src='/img/partners/".$logo['img']."' /></a>
		    <br />
		    <span onclick='deleteLogo(\"".$logo['id']."\")' class='photoLink'>Удалить</span>
        </div>
    ";
}