<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 17.05.2018
 * Time: 17:49
 */

include("../../connect.php");

$req = false;
ob_start();

$id = $mysqli->real_escape_string($_POST['textSelect']);
$text = $mysqli->real_escape_string($_POST['text']);

if($mysqli->query("UPDATE akvasan_text SET text = '".$text."' WHERE id = '".$id."'")) {
    echo "ok";
} else {
    echo "failed";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;