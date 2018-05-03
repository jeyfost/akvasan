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

	<link rel="shortcut icon" href="/img/system/favicon.ico" />
	<link rel="stylesheet" href="/libs/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/libs/lightview/css/lightview/lightview.css" />
    <link rel="stylesheet" type="text/css" href="/libs/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="/libs/slick/slick-theme.css" />
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="/css/media.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
    <script type="text/javascript" src="/libs/lightview/js/lightview/lightview.js"></script>
    <script type="text/javascript" src="/libs/slick/slick.min.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript" src="/js/index.js"></script>

    <!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
    <!-- Google Analytics counter --><!-- /Google Analytics counter -->

</head>

<body>

    <!-- MENU START -->

    <div class="mobileMenu">
        <div class="row" id="mobileMenuClose"><i class="fa fa-times" aria-hidden="true" onclick="closeMobileMenu()"></i></div>
        <div class="row text-center mobile mobileActive">Главная</div>
        <div class="row text-center mobile"><a href="/catalogue/">Каталог</a></div>
        <div class="row text-center mobile"><a href="/delivery/">Доставка и оплата</a></div>
        <div class="row text-center mobile"><a href="/about/">О компании</a></div>
        <div class="row text-center mobile"><a href="/reviews/">Отзывы</a></div>
        <div class="row text-center mobile"><a href="/contacts/">Контакты</a></div>
    </div>

    <div class="topMenu">
        <div class="mobileMenuIcon" onclick="showMobileMenu()"><i class="fa fa-bars" aria-hidden="true"></i></div>
        <div class="innerSection" id="menu">
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
                <div class="menuRow">
                    <div class="iconContainer"><img src="/img/system/life.png" /></div>
                    <div class="textContainer"><a href="tel:<?= COUNTRY_CODE ?> (<?= LIFE_CODE ?>) <?= LIFE_NUMBER ?>"><?= COUNTRY_CODE ?> <?= LIFE_CODE ?> <b><?= LIFE_NUMBER ?></b></a></div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="container25" id="timeContainer">
                <b>Время работы:</b>
                <br /><br />
                <span>Пн-Пт: 9:00 - 18:00</span>
                <br />
                <span>Сб: 10:00-17</span>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="innerSection" id="searchSection">
        <form method="post">
            <input id="searchInput" name="search" class="search" placeholder="Поиск..." />
        </form>
    </div>

    <!-- MENU END -->

    <div class="section white">
        <div class="header"><h1>Новые поступления</h1></div>
        <div class="row text-center">
            <?php
            $goodResult = $mysqli->query("SELECT * FROM akvasan_catalogue ORDER BY date DESC LIMIT 0, 5");
            while($good = $goodResult->fetch_assoc()) {
                $categoryResult = $mysqli->query("SELECT * FROM akvasan_categories WHERE id = '".$good['category']."'");
                $category = $categoryResult->fetch_array();

                $subcategoryResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE id = '".$good['subcategory']."'");
                $subcategory = $subcategoryResult->fetch_assoc();

                $r = intval($good['price']);
                $k = intval(($good['price'] - $r) * 100);

                if($k == 0) {
                    $k = "00";
                } else {
                    if(strlen($k == 1)) {
                        $k = "0".$k;
                    }
                }

                $price = $r." руб. ".$k." коп.";

                echo "
                        <div class='goodContainer'>
                            <div class='goodContainerPhoto'>
                                <a href='/img/catalogue/big/".$good['photo']."' class='lightview' data-lightview-options='skin: \"light\"'><img src='/img/catalogue/preview/".$good['preview']."' /></a>
                            </div>
                            <div class='goodContainerDescription'>
                                <div class='goodContainerName'><a href='/catalogue/".$category['url']."/".$subcategory['url']."/".$good['url']."'>".$good['name']."</a></div>
                                <br />
                                <div class='goodContainerPrice'>".$price."</div>
                                <br />
                                <a href='/catalogue/".$category['url']."/".$subcategory['url']."/".$good['url']."'><div class='promoButton'>Подробнее</div></a>
                            </div>
                        </div>
                    ";
            }
            ?>
        </div>
    </div>

    <div class="section">
        <div class="header"><h1>Лидеры продаж</h1></div>
        <div class="row text-center">
            <?php
                $goodResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE leader = '1'");
                while($good = $goodResult->fetch_assoc()) {
                    $categoryResult = $mysqli->query("SELECT * FROM akvasan_categories WHERE id = '".$good['category']."'");
                    $category = $categoryResult->fetch_array();

                    $subcategoryResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE id = '".$good['subcategory']."'");
                    $subcategory = $subcategoryResult->fetch_assoc();

                    $r = intval($good['price']);
                    $k = intval(($good['price'] - $r) * 100);

                    if($k == 0) {
                        $k = "00";
                    } else {
                        if(strlen($k == 1)) {
                            $k = "0".$k;
                        }
                    }

                    $price = $r." руб. ".$k." коп.";

                    echo "
                            <div class='goodContainer'>
                                <div class='goodContainerPhoto'>
                                    <a href='/img/catalogue/big/".$good['photo']."' class='lightview' data-lightview-options='skin: \"light\"'><img src='/img/catalogue/preview/".$good['preview']."' /></a>
                                </div>
                                <div class='goodContainerDescription'>
                                    <div class='goodContainerName'><a href='/catalogue/".$category['url']."/".$subcategory['url']."/".$good['url']."'>".$good['name']."</a></div>
                                    <br />
                                    <div class='goodContainerPrice'>".$price."</div>
                                    <br />
                                    <a href='/catalogue/".$category['url']."/".$subcategory['url']."/".$good['url']."'><div class='promoButton'>Подробнее</div></a>
                                </div>
                            </div>
                        ";
                }
            ?>
        </div>
    </div>

    <div class="section white" id="sliderContainer">
        <div class="slider">
            <?php
                $logoResult = $mysqli->query("SELECT * FROM akvasan_partners");
                while($logo = $logoResult->fetch_assoc()) {
                    echo "<div><img src='/img/partners/".$logo['img']."' /></div>";
                }
            ?>
        </div>
    </div>

    <div class="section">
        <div class="header"><h1>Преимущества AKVASAN.BY</h1></div>
        <div class="row text-center">
            <div class="advantageIconContainer">
                <div class="advantagePhoto"><img src="/img/system/icon-price.png" /></div>
                <div class="advantageText">ПРИЯТНЫЕ ЦЕНЫ<br />БЕЗ ПЕРЕПЛАТ</div>
            </div>
            <div class="advantageIconContainer">
                <div class="advantagePhoto"><img src="/img/system/icon-good.png" /></div>
                <div class="advantageText">НАДЁЖНЫЙ<br />СЕРВИС</div>
            </div>
            <div class="advantageIconContainer">
                <div class="advantagePhoto"><img src="/img/system/icon-delivery.png" /></div>
                <div class="advantageText">БЕСПЛАТНАЯ ДОСТАВКА<br />ПО МОГИЛЁВУ</div>
            </div>
            <div class="advantageIconContainer">
                <div class="advantagePhoto"><img src="/img/system/icon-warranty.png" /></div>
                <div class="advantageText">ГАРАНТИЯ<br />КАЧЕСТВА</div>
            </div>
            <div class="advantageIconContainer">
                <div class="advantagePhoto"><img src="/img/system/icon-handshake.png" /></div>
                <div class="advantageText">ОФИЦИАЛЬНЫЙ<br />ИМПОРТЁР</div>
            </div>
        </div>
    </div>

    <div class="section white" style="padding-bottom: 20px;">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A6d498f3ad922bd93961b582ad2abcbadd59babd772e2b02d80234d0570285614&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=false"></script>
    </div>

</body>

</html>