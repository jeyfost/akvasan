<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 08.05.2018
 * Time: 10:16
 */

include("../scripts/connect.php");

$pageResult = $mysqli->query("SELECT * FROM akvasan_pages WHERE url = 'warranty'");
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

    <link rel="apple-touch-icon" sizes="180x180" href="/img/system/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/system/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/system/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/system/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/system/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="/libs/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="stylesheet" href="/css/media.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>

    <style>
        #page-preloader {position: fixed; left: 0; top: 0; right: 0; bottom: 0; background: #fff; z-index: 100500;}
        #page-preloader .spinner {width: 32px; height: 32px; position: absolute; left: 50%; top: 50%; background: url('/img/system/spinner.gif') no-repeat 50% 50%; margin: -16px 0 0 -16px;}
    </style>

    <script type="text/javascript">
        $(window).on('load', function () {
            const $preloader = $('#page-preloader'), $spinner = $preloader.find('.spinner');
            $spinner.delay(500).fadeOut();
            $preloader.delay(850).fadeOut();
        });
    </script>

    <!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
    <!-- Google Analytics counter --><!-- /Google Analytics counter -->

</head>

<body>

<div id="page-preloader"><span class="spinner"></span></div>

<!-- MENU START -->

<div class="mobileMenu">
    <div class="row" id="mobileMenuClose"><i class="fa fa-times" aria-hidden="true" onclick="closeMobileMenu()"></i></div>
    <div class="row text-center mobile">Главная</div>
    <div class="row text-center mobile"><a href="/catalogue">Каталог</a></div>
    <div class="row text-center mobile"><a href="/delivery">Доставка и оплата</a></div>
    <div class="row text-center mobile"><a href="/about">О компании</a></div>
    <div class="row text-center mobile"><a href="/reviews">Отзывы</a></div>
    <div class="row text-center mobile"><a href="/contacts">Контакты</a></div>
</div>

<div class="topMenu">
    <div class="mobileMenuIcon" onclick="showMobileMenu()"><i class="fa fa-bars" aria-hidden="true"></i></div>
    <div class="innerSection" id="menu">
        <div class="menuPointContainer" id="mainContainer" onmouseover="menuPoint('mainContainer', 'mainTopLine', 1)" onmouseout="menuPoint('mainContainer', 'mainTopLine', 0)">
            <div class="topLine" id="mainTopLine"></div>
            <a href="/"><div class="menuPoint" id="mainPoint">Главная</div></a>
        </div>
        <div class="menuPointContainer" id="catalogueContainer" onmouseover="menuPoint('catalogueContainer', 'catalogueTopLine', 1)" onmouseout="menuPoint('catalogueContainer', 'catalogueTopLine', 0)">
            <div class="topLine" id="catalogueTopLine"></div>
            <a href="/catalogue"><div class="menuPoint" id="cataloguePoint">Каталог</div></a>
        </div>
        <div class="menuPointContainer" id="deliveryContainer" onmouseover="menuPoint('deliveryContainer', 'deliveryTopLine', 1)" onmouseout="menuPoint('deliveryContainer', 'deliveryTopLine', 0)">
            <div class="topLine" id="deliveryTopLine"></div>
            <a href="/delivery"><div class="menuPoint" id="deliveryPoint">Доставка и оплата</div></a>
        </div>
        <div class="menuPointContainer" id="aboutContainer" onmouseover="menuPoint('aboutContainer', 'aboutTopLine', 1)" onmouseout="menuPoint('aboutContainer', 'aboutTopLine', 0)">
            <div class="topLine" id="aboutTopLine"></div>
            <a href="/about"><div class="menuPoint" id="aboutPoint">О компании</div></a>
        </div>
        <div class="menuPointContainer" id="reviewsContainer" onmouseover="menuPoint('reviewsContainer', 'reviewsTopLine', 1)" onmouseout="menuPoint('reviewsContainer', 'reviewsTopLine', 0)">
            <div class="topLine" id="reviewsTopLine"></div>
            <a href="/reviews"><div class="menuPoint" id="reviewsPoint">Отзывы</div></a>
        </div>
        <div class="menuPointContainer" id="contactsContainer" onmouseover="menuPoint('contactsContainer', 'contactsTopLine', 1)" onmouseout="menuPoint('contactsContainer', 'contactsTopLine', 0)">
            <div class="topLine" id="contactsTopLine"></div>
            <a href="/contacts"><div class="menuPoint" id="contactsPoint">Контакты</div></a>
        </div>
    </div>
</div>

<div class="bottomMenu">
    <div class="container">
        <div class="container25" id="logo">
            <a href="/"><img src="/img/system/logo.jpg"></a>
        </div>
        <div class="container25" id="webContainer">
            <div class="menuRow">
                <div class="iconContainer"><img src="/img/system/viber.png" /></div>
                <div class="textContainer"><a href="tel:<?= COUNTRY_CODE ?> (<?= VIBER_CODE ?>) <?= VIBER_NUMBER ?>"><?= COUNTRY_CODE ?> <?= VIBER_CODE ?> <b><?= VIBER_NUMBER ?></b></a></div>
                <div class="clear"></div>
            </div>
            <div class="menuRow">
                <div class="iconContainer"><img src="/img/system/skype.jpg" /></div>
                <div class="textContainer"><a href="skype:<?= SKYPE_LOGIN ?>"><?= SKYPE_LOGIN ?></div>
                <div class="clear"></div>
            </div>
            <div class="menuRow">
                <div class="iconContainer"><img src="/img/system/at.png" /></div>
                <div class="textContainer"><a href="mailto:<?= CONTACT_EMAIL ?>"><?= CONTACT_EMAIL ?></a></div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="container25" id="phoneContainer">
            <div class="menuRow">
                <div class="iconContainer"><img src="/img/system/velcom.png" /></div>
                <div class="textContainer"><a href="tel:<?= COUNTRY_CODE ?> (<?= VELCOM_CODE ?>) <?= VELCOM_NUMBER ?>"><?= COUNTRY_CODE ?> <?= VELCOM_CODE ?> <b><?= VELCOM_NUMBER ?></b></a></div>
                <div class="clear"></div>
            </div>
            <div class="menuRow">
                <div class="iconContainer"><img src="/img/system/mts.jpg" /></div>
                <div class="textContainer"><a href="tel:<?= COUNTRY_CODE ?> (<?= MTS_CODE ?>) <?= MTS_NUMBER ?>"><?= COUNTRY_CODE ?> <?= MTS_CODE ?> <b><?= MTS_NUMBER ?></b></a></div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="container25" id="timeContainer">
            <b>Время работы:</b>
            <br /><br />
            <span>Пн: выходной</span>
            <br />
            <span>Вт - Вс: 9:00-15:00</span>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="innerSection" id="searchSection">
    <form method="post">
        <input id="searchInput" name="search" placeholder="Поиск..." onkeyup="siteSearch()" onclick="siteSearch()" />
    </form>
</div>

<div class="searchList"></div>

<!-- MENU END -->

<div class="section white ndra-container">
    <div class="header"><h1>Гарантия на товар магазина Akvasan.by</h1></div>
    <div class="container text-left">
        <?php
            $textResult= $mysqli->query("SELECT text FROM akvasan_text WHERE url = 'warranty'");
            $text = $textResult->fetch_array(MYSQLI_NUM);

            echo "<br /><div style='font-size: 16px;'>".$text[0]."</div>";
        ?>
    </div>
</div>

<!-- FOOTER START -->

<div class="topFooter">
    <div class="container">
        <div class="container25" id="footerLogo">
            <a href="/"><img src="/img/system/logo.png"></a>
        </div>
        <div class="container25" id="footerRightContainer">
            <a href="/refund">Замена и возврат товара</a>
            <br />
            <a href="/warranty"><b>Гарантия</b></a>
            <br /><br />
            <img src="/img/system/pay-logos.png" />
            <br /><br />
            <span><a href="/">akvasan.by</a> &copy; 2007-<?= date('Y') ?></span>
        </div>
        <div class="container25" id="footerMenuContainer">
            <a href="/">Главная</a>
            <br />
            <a href="/catalogue">Каталог</a>
            <br />
            <a href="/delivery">Доставка и оплата</a>
            <br />
            <a href="/about">О компании</a>
            <br />
            <a href="/reviews">Отзывы</a>
            <br />
            <a href="/contacts">Контакты</a>
        </div>
        <div class="container25" id="footerPhoneContainer">
            <div class="menuRow">
                <div class="iconContainer"><img src="/img/system/velcom.png" /></div>
                <div class="textContainer"><a href="tel:<?= COUNTRY_CODE ?> (<?= VELCOM_CODE ?>) <?= VELCOM_NUMBER ?>"><?= COUNTRY_CODE ?> <?= VELCOM_CODE ?> <b><?= VELCOM_NUMBER ?></b></a></div>
                <div class="clear"></div>
            </div>
            <div class="menuRow">
                <div class="iconContainer"><img src="/img/system/mts.jpg" /></div>
                <div class="textContainer"><a href="tel:<?= COUNTRY_CODE ?> (<?= MTS_CODE ?>) <?= MTS_NUMBER ?>"><?= COUNTRY_CODE ?> <?= MTS_CODE ?> <b><?= MTS_NUMBER ?></b></a></div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="bottomFooter">
    <div class="innerSection" id="footerInnerSection">
        <div class="footerLeft">
            <span>ИП Борисова Т.В. г. Могилёв, Могилёвский рынок, ул. Быховская, 6, павильон S183. Зарегистрирован администрацией Ленинского района г. Могилёва в едином государственном регистре юридических лиц и индивидуальных предпринимателей 31.10.2007 г. за №790424627.</span>
            <br /><br />
            <span>Создание сайта: </span><a href="https://airlab.by/"><span class="footerLink">airlab.by</span></a>
        </div>
        <div class="footerRight">
            <b>Заказы по телефону:</b>
            <br /><br />
            <span>Пн: выходной</span>
            <br />
            <span>Вт - Вс: 9:00 - 15:00</span>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!-- FOOTER END -->

<div onclick="scrollToTop()" id="scroll"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>

</body>

</html>