<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 08.05.2018
 * Time: 12:35
 */

include("connect.php");

$email = $mysqli->real_escape_string($_POST['email']);

if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "ok";
} else {
    echo "failed";
}