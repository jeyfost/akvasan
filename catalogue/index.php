<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 11.05.2018
 * Time: 18:36
 */

include("../scripts/connect.php");

$url = substr($_SERVER['REQUEST_URI'], 1);
$url = explode("/", $url);

/*
 * $url[1] — раздел или страница каталога, если $url[1] — это число
 * $url[2] — подраздел или страница раздела, если $url[2] — это число
 * $url[3] — товар или страница подраздела, если $url[3] — это число
 */

if(!empty($url[1])) {
    $pageNumber = (int)$url[1];
    $pageString = (string)$url[1];
    $pageNumber = (string)$pageNumber;

    if($pageNumber == $pageString) {
        //Значит $url[1] — это число

        $type = "catalogue";
        $page = $pageNumber;
    } else {
        $categoryResult = $mysqli->query("SELECT * FROM akvasan_categories WHERE url = '".$mysqli->real_escape_string($url[1])."'");

        if($categoryResult->num_rows > 0) {
            $category = $categoryResult->fetch_assoc();

            if(!empty($url[2])) {
                $pageNumber = (int)$url[2];
                $pageString = (string)$url[2];
                $pageNumber = (string)$pageNumber;

                if($pageNumber == $pageString) {
                    //Значит $url[2] — это число

                    $type = "category";
                    $page = $pageNumber;
                } else {
                    $subcategoryResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE url = '".$mysqli->real_escape_string($url[2])."'");

                    if($subcategoryResult->num_rows > 0) {
                        $subcategory = $subcategoryResult->fetch_assoc();

                        if(!empty($url[3])) {
                            $pageNumber = (int)$url[3];
                            $pageString = (string)$url[3];
                            $pageNumber = (string)$pageNumber;

                            if($pageNumber == $pageString) {
                                //Значит $url[3] — это число

                                $type = "subcategory";
                                $page = $pageNumber;
                            } else {
                                $goodResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE url = '".$mysqli->real_escape_string($url[3])."'");

                                if($goodResult->num_rows > 0) {
                                    $good = $goodResult->fetch_assoc();

                                    $type = "good";
                                } else {
                                    header("Location: ../catalogue/".$url[1]."/".$url[2]);
                                }
                            }
                        } else {
                            $type = "subcategory";
                        }
                    } else {
                        header("Location: ../catalogue/".$url[1]);
                    }
                }
            } else {
                $type = "category";
            }
        } else {
            header("Location: ../catalogue");
        }
    }
} else {
    $type = "catalogue";
}

if($type != "good") {
    switch ($type) {
        case "catalogue":
            $quantityResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue");
            break;
        case "category":
            $quantityResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue WHERE category = '".$category['id']."'");
            break;
        case "subcategory":
            $quantityResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue WHERE subcategory = '".$subcategory['id']."'");
            break;
        default:
            $quantityResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue");
            break;
    }

    $quantity = $quantityResult->fetch_array(MYSQLI_NUM);

    if ($quantity[0] > GOODS_ON_PAGE) {
        if ($quantity[0] % GOODS_ON_PAGE != 0) {
            $numbers = intval(($quantity[0] / GOODS_ON_PAGE) + 1);
        } else {
            $numbers = intval($quantity[0] / GOODS_ON_PAGE);
        }
    } else {
        $numbers = 1;
    }

    if(empty($page)) {
        $page = 1;
    } else {
        if($page < 1 or $page > $numbers) {
            switch ($type) {
                case "catalogue":
                    header("Location: ../catalogue");
                    break;
                case "category":
                    header("Location: ../../catalogue/".$url[1]);
                    break;
                case "subcategory":
                    header("Location: ../../../catalogue/".$url[1]."/".$url[2]);
                    break;
                default:
                    break;
            }
        } else {
            if($page == 1) {
                switch ($type) {
                    case "catalogue":
                        header("Location: ../catalogue");
                        break;
                    case "category":
                        header("Location: ../../catalogue/".$url[1]);
                        break;
                    case "subcategory":
                        header("Location: ../../../catalogue/".$url[1]."/".$url[2]);
                        break;
                    default:
                        break;
                }
            }
        }
    }

    $start = $page * GOODS_ON_PAGE - GOODS_ON_PAGE;
}

$pageResult = $mysqli->query("SELECT * FROM akvasan_pages WHERE url = 'catalogue'");
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

    <title>
        <?php
            switch ($type) {
                case "catalogue":
                    echo $page['title'];
                    break;
                case "category":
                    echo $category['name'];
                    break;
                case "subcategory":
                    echo $subcategory['name'];
                    break;
                case "good":
                    echo $good['name'];
                    break;
                default:
                    echo $page['title'];
                    break;
            }
        ?>
    </title>

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
    <script type="text/javascript" src="/js/catalogue.js"></script>

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
    <div class="row text-center mobile mobileActive"><a href="/catalogue">Каталог</a></div>
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
        <div class="menuPointContainer active" id="catalogueContainer">
            <div class="topLine white" id="catalogueTopLine"></div>
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
        <div class="menuPointContainer " id="contactsContainer" onmouseover="menuPoint('contactsContainer', 'contactsTopLine', 1)" onmouseout="menuPoint('contactsContainer', 'contactsTopLine', 0)">
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
        <input id="searchInput" name="search" placeholder="Поиск..." onkeyup="siteSearch()" onclick="siteSearch()" />
    </form>
</div>

<div class="searchList"></div>

<!-- MENU END -->

<div class="ndra-container">
    <div class="section white">
        <div class="container breadcrumbs text-left">
            <div style="margin-left: 10px;">
                <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Главная</a> /
                <?php
                    if(empty($category['url'])) {
                        echo "Каталог";
                    } else {
                        echo "<a href='/catalogue'>Каталог</a> / ";

                        if(empty($subcategory['url'])) {
                            echo $category['name'];
                        } else {
                            echo "<a href='/catalogue/".$category['url']."'>".$category['name']."</a> / ";

                            if(empty($good['url'])) {
                                echo $subcategory['name'];
                            } else {
                                echo "<a href='/catalogue/".$category['url']."/".$subcategory['url']."'>".$subcategory['name']."</a> / ".$good['name'];
                            }
                        }
                    }
                ?>
            </div>
        </div>

        <br /><br />

        <div class="container">
            <table class="catalogueMenu">
                <thead>
                    <tr class="catalogueMenuPoint">
                        <td class="tdHead"><i class="fa fa-level-down" aria-hidden="true"></i> Выберите раздел</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $categoriesResult = $mysqli->query("SELECT * FROM akvasan_categories ORDER BY name");
                        while ($categories = $categoriesResult->fetch_assoc()) {
                            echo "
                                <tr class='catalogueMenuPoint'>
                                    <td id='category".$categories['id']."' onclick='document.location=\"/catalogue/".$categories['url']."\"' onmouseover='catalogueMenu(1, \"category".$categories['id']."\", \"categoryName".$categories['id']."\")' onmouseout='catalogueMenu(0, \"category".$categories['id']."\", \"categoryName".$categories['id']."\")'"; if((!empty($category['url']) or !empty($subcategory['url'])) and $category['url'] == $categories['url']) {echo " class='tdActive'";} echo ">
                                        <a href='/catalogue/".$categories['url']."'>
                                            <span id='categoryName".$categories['id']."'>".$categories['name']."</span>
                                        </a>
                                    </td>
                                </tr>
                            ";

                            if((!empty($category['url']) or !empty($subcategory['url'])) and $category['url'] == $categories['url']) {
                                $subcategoriesResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE category_id = '".$categories['id']."'");

                                if($subcategoriesResult->num_rows > 0) {
                                    while ($subcategories = $subcategoriesResult->fetch_assoc()) {
                                        echo "
                                            <tr class='catalogueMenuPoint'>
                                                <td id='subcategory".$subcategories['id']."' onclick='document.location=\"/catalogue/".$categories['url']."/".$subcategories['url']."\"' onmouseover='catalogueMenu(1, \"subcategory".$subcategories['id']."\", \"subcategoryName".$subcategories['id']."\")' onmouseout='catalogueMenu(0, \"subcategory".$subcategories['id']."\", \"subcategoryName".$subcategories['id']."\")'"; if(!empty($subcategory['url']) and $subcategory['url'] == $subcategories['url']) {echo " class='tdActive'";} echo ">
                                                    <a href='/catalogue/".$categories['url']."/".$subcategories['url']."'>
                                                        <span id='subcategoryName".$subcategories['id']."'>— ".$subcategories['name']."</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        ";
                                    }
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
            <div class="catalogueContent">
                <div class="header">
                    <h1>
                        <?php
                        switch ($type) {
                            case "catalogue":
                                echo $page['title'];
                                break;
                            case "category":
                                echo $category['name'];
                                break;
                            case "subcategory":
                                echo $subcategory['name'];
                                break;
                            case "good":
                                echo $good['name'];
                                break;
                            default:
                                echo $page['title'];
                                break;
                        }
                        ?>
                    </h1>
                </div>

                <div class="row">
                    <?php
                        switch($type) {
                            case "catalogue":
                                $catalogueResult = $mysqli->query("SELECT * FROM akvasan_catalogue ORDER BY name");
                                break;
                            case "category":
                                $catalogueResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE category = '".$category['id']."' ORDER BY name");
                                break;
                            case "subcategory":
                                $catalogueResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE subcategory = '".$category['id']."' ORDER BY name");
                                break;
                            case "good":
                                $catalogueResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE id = '".$good['id']."'");
                                break;
                            default:
                                $catalogueResult = $mysqli->query("SELECT * FROM akvasan_catalogue ORDER BY name");
                                break;
                        }

                        if($type == "good") {
                            //Режим отображения товара
                            $catalogue = $catalogueResult->fetch_assoc();
                        } else {
                            //Режим отображения каталога
                            while($catalogue = $catalogueResult->fetch_assoc()) {

                            }
                        }
                    ?>
                </div>
            </div>
            <div class="clear"></div>

            <!-- PLACE PAGINATION HERE -->
        </div>
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
            <a href="/warranty">Гарантия</a>
            <br /><br />
            <img src="/img/system/pay-logos.png" />
            <br /><br />
            <span><a href="/">akvasan.by</a> &copy; 2010-<?= date('Y') ?></span>
        </div>
        <div class="container25" id="footerMenuContainer">
            <a href="/">Главная</a>
            <br />
            <a href="/catalogue"><b>Каталог</b></a>
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
            <div class="menuRow">
                <div class="iconContainer"><img src="/img/system/life.png" /></div>
                <div class="textContainer"><a href="tel:<?= COUNTRY_CODE ?> (<?= LIFE_CODE ?>) <?= LIFE_NUMBER ?>"><?= COUNTRY_CODE ?> <?= LIFE_CODE ?> <b><?= LIFE_NUMBER ?></b></a></div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="bottomFooter">
    <div class="innerSection" id="footerInnerSection">
        <div class="footerLeft">
            <span>ИП Борисова Т.В. г. Могилёв, ул. Быховская, 6. Зарегистрирован в торговом реестре 01.01.2010 в Могилёвском облостном исполнительном комитете. УНП 77777777. Свидетельство о государственной регистрации выдано Могилёвским областным исполкомом 01.01.2010 г.</span>
            <br /><br />
            <span>Создание сайта: </span><a href="https://airlab.by/"><span class="footerLink">airlab.by</span></a>
        </div>
        <div class="footerRight">
            <b>Заказы по телефону:</b>
            <br /><br />
            <span>Пн-Пт: 9:00 - 18:00</span>
            <br />
            <span>Сб: 10:00 - 17:00</span>
            <br />
            <span>Вс: выходной</span>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!-- FOOTER END -->

<div onclick="scrollToTop()" id="scroll"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>

</body>

</html>
