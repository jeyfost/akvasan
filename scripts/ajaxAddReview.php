<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 11.05.2018
 * Time: 15:59
 */

include("connect.php");

$req = false;
ob_start();

$name = $mysqli->real_escape_string($_POST['name']);
$email = $mysqli->real_escape_string($_POST['email']);
$good = $mysqli->real_escape_string($_POST['good']);
$text = $mysqli->real_escape_string(nl2br($_POST['text']));

if ($mysqli->query("INSERT INTO akvasan_reviews (date, name, email, good, text, showing) VALUES ('" . date("Y-m-d H:i:s") . "', '" . $name . "', '" . $email . "', '" . $good . "', '" . $text . "', '0')")) {
    $from = "Akvasan.by <no-reply@akvasan.by>";
    $to = CONTACT_EMAIL;
    $subject = "На сайте Akvasan.by был добавлен отзыв";

    $headers = "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: " . $from;

    $text = "
	    <div style='width: 100%; height: 100%; background-color: #fafafa; padding-top: 5px; padding-bottom: 20px;'>
		    <center>
		    <div style='padding: 20px; box-shadow: 0 5px 15px -4px rgba(0, 0, 0, 0.4); background-color: #fff; width: 600px; text-align: left;'>
			    <p>На сайте Akvasan.by был добавлен новый отзыв. Он будет отображён только после валидации в разделе 'Отзывы' панели адмнистрирования.</p>
		    </div>
		    <br /><br />
		    </center>
	    </div>
    ";

    $message = $text;

    mail($to, $subject, $message, $headers);

    echo "ok";
} else {
    echo "failed";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;