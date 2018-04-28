<?php

include("scripts/connect.php");

$pageResult = $mysqli->query("SELECT * FROM akvasan_pages WHERE id = '1'");
$page = $pageResult->fetch_assoc();

?>

<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->

<head>

	<title><?= $page['title'] ?></title>

    <meta charset="utf-8" />
	<meta name="description" content="<?= $page['description'] ?>" />
	<meta name="keywords" content="<?= $page['keywords'] ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://fonts.googleapis.com/css?family=Istok+Web" rel="stylesheet">

	<link rel="shortcut icon" href="/img/system/favicon.png" />
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="/css/media.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/common.js"></script>

    <!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
    <!-- Google Analytics counter --><!-- /Google Analytics counter -->

</head>

<body>

    <div class="topMenu">
        <div class="innerSection">
            <div class="menuPointContainer active" id="mainContainer">
                <div class="topLine white" id="mainTopLine"></div>
                <a href="/"><div class="menuPoint" id="mainPoint">Главная</div></a>
            </div>
            <div class="menuPointContainer" id="catalogueContainer" onmouseover="menuPoint('catalogueContainer', 'catalogueTopLine', 1)" onmouseout="menuPoint('catalogueContainer', 'catalogueTopLine', 0)">
                <div class="topLine" id="catalogueTopLine"></div>
                <a href="/catalogue/"><div class="menuPoint" id="cataloguePoint">Каталог</div></a>
            </div>
            <div class="menuPointContainer" id="deliveryContainer" onmouseover="menuPoint('deliveryContainer', 'deliveryTopLine', 1)" onmouseout="menuPoint('deliveryContainer', 'deliveryTopLine', 0)">
                <div class="topLine" id="deliveryTopLine"></div>
                <a href="/delivery/"><div class="menuPoint" id="deliveryPoint">Доставка и оплата</div></a>
            </div>
            <div class="menuPointContainer" id="aboutContainer" onmouseover="menuPoint('aboutContainer', 'aboutTopLine', 1)" onmouseout="menuPoint('aboutContainer', 'aboutTopLine', 0)">
                <div class="topLine" id="aboutTopLine"></div>
                <a href="/about/"><div class="menuPoint" id="aboutPoint">О компании</div></a>
            </div>
            <div class="menuPointContainer" id="reviewsContainer" onmouseover="menuPoint('reviewsContainer', 'reviewsTopLine', 1)" onmouseout="menuPoint('reviewsContainer', 'reviewsTopLine', 0)">
                <div class="topLine" id="reviewsTopLine"></div>
                <a href="/reviews/"><div class="menuPoint" id="reviewsPoint">Отзывы</div></a>
            </div>
            <div class="menuPointContainer" id="contactsContainer" onmouseover="menuPoint('contactsContainer', 'contactsTopLine', 1)" onmouseout="menuPoint('contactsContainer', 'contactsTopLine', 0)">
                <div class="topLine" id="contactsTopLine"></div>
                <a href="/contacts/"><div class="menuPoint" id="contactsPoint">Контакты</div></a>
            </div>
        </div>
    </div>

</body>

</html>