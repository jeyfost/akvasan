<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 08.05.2018
 * Time: 12:35
 */

include("connect.php");
include("recaptcha.php");

$req = false;
ob_start();

$name = $mysqli->real_escape_string($_POST['name']);
$email = $mysqli->real_escape_string($_POST['email']);
$phone = $mysqli->real_escape_string($_POST['phone']);
$t = $_POST['message'];

$from = $name." <".$email.">";
$to = CONTACT_EMAIL;
$reply = $email;
$subject = "Письмо с сайта akvasan.by";

$secret = "6Lcb7FcUAAAAAO3XN4dj_-gmVAHs19Lt0j9jbh7y";
$response = null;
$reCaptcha = new ReCaptcha($secret);

if($_POST['g-recaptcha-response']) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER['REMOTE_ADDR'],
        $_POST['g-recaptcha-response']
    );
}

if($response != null && $response->success) {
    $headers = "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: ".$from;

    $text = "
        <div style='width: 100%; height: 100%; background-color: #fafafa; padding-top: 5px; padding-bottom: 20px;'>
            <center>
                <div style='padding: 20px; box-shadow: 0 5px 15px -4px rgba(0, 0, 0, 0.4); background-color: #fff; width: 600px; text-align: left;'>
                    <b>Имя:</b> ".$name."
                    <br />
                    <b>Email:</b> ".$email."
                    <br />
                    <b>Телефон:</b> ".$phone."
                    <br />
                    <br />
                    ".$t."
                </div>
			    <br /><br />
		    </center>
	    </div>
    ";

    $message = $text;

    if(mail($to, $subject, $message, $headers)) {
        echo "ok";
    } else {
        echo "failed";
    }
} else {
    echo "captcha";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;