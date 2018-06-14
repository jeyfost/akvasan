<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 14.06.2018
 * Time: 14:55
 */

session_start();

include("../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);
$type = $mysqli->real_escape_string($_POST['type']);

$_SESSION['faucet_manufacturer'] = $id;