<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 16.05.2018
 * Time: 17:05
 */

include("../../connect.php");

$oldLogin = $mysqli->real_escape_string($_POST['oldLogin']);
$oldPassword = $mysqli->real_escape_string($_POST['oldPassword']);
$newLogin = $mysqli->real_escape_string($_POST['newLogin']);
$newPassword = $mysqli->real_escape_string($_POST['newPassword']);

$userCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_users WHERE login = '".$oldLogin."' and password = '".md5($oldPassword)."'");
$userCheck = $userCheckResult->fetch_array(MYSQLI_NUM);

if($userCheck[0] > 0) {
    $userResult = $mysqli->query("SELECT * FROM akvasan_users WHERE login = '".$oldLogin."' and password = '".md5($oldPassword)."'");
    $user = $userResult->fetch_assoc();

    if(($newLogin == $user['login']) and empty($newPassword) or (empty($newLogin) and md5($newPassword) == $user['password']) or ($newLogin == $user['login'] and md5($newPassword) == $user['password'])) {
        echo "duplicate";
    } else {
        if(!empty($newLogin)) {
            if($mysqli->query("UPDATE akvasan_users SET login = '".$newLogin."' WHERE id = '".$user['id']."'")) {
                if(!empty($newPassword)) {
                    if($mysqli->query("UPDATE akvasan_users SET password = '".md5($newPassword)."'")) {
                        echo "ok";
                    } else {
                        echo "failed";
                    }
                } else {
                    echo "ok";
                }
            } else {
                echo "failed";
            }
        } else {
            if(!empty($newPassword)) {
                if($mysqli->query("UPDATE akvasan_users SET password = '".md5($newPassword)."'")) {
                    echo "ok";
                } else {
                    echo "failed";
                }
            }
        }
    }
} else {
    echo "incorrect";
}