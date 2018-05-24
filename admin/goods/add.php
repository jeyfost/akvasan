<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 24.05.2018
 * Time: 15:40
 */


session_start();
include("../../scripts/connect.php");

if($_SESSION['userID'] != 1) {
    header("Location: ../");
}

if(!empty($_REQUEST['c'])) {
    $categoryCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_categories WHERE id = '".$mysqli->real_escape_string($_REQUEST['c'])."'");
    $categoryCheck = $categoryCheckResult->fetch_array(MYSQLI_NUM);

    if($categoryCheck[0] == 0) {
        header("Location: add.php");
    }
}

if(!empty($_REQUEST['s'])) {
    $subcategoryCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_subcategories WHERE id = '".$mysqli->real_escape_string($_REQUEST['s'])."' AND category_id = '".$mysqli->real_escape_string($_REQUEST['c'])."'");
    $subcategoryCheck = $subcategoryCheckResult->fetch_array(MYSQLI_NUM);

    if($subcategoryCheck[0] == 0) {
        header("Location: add.php?c=".$_REQUEST['c']);
    }
}

?>

<!DOCTYPE html>

<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->

<head>

    <meta charset="utf-8" />

    <title>Панель администрирования | Добавление товара</title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="apple-touch-icon" sizes="180x180" href="/img/system/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/system/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/system/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/system/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/system/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" type="text/css" href="/css/admin.css" />
    <link rel="stylesheet" href="/libs/font-awesome-4.7.0/css/font-awesome.css" />

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/libs/notify/notify.js"></script>
    <script type="text/javascript" src="/js/admin/common.js"></script>
    <script type="text/javascript" src="/js/admin/goods/add.js"></script>

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

<div id="topLine">
    <div id="logo">
        <a href="/"><span><i class="fa fa-home" aria-hidden="true"></i> <?= $_SERVER['HTTP_HOST'] ?></span></a>
    </div>
    <a href="admin.php"><span class="headerText">Панель администрирвания</span></a>
    <div id="exit" onclick="exit()">
        <span>Выйти <i class="fa fa-sign-out" aria-hidden="true"></i></span>
    </div>
</div>
<div id="leftMenu">
    <a href="/admin/pages/">
        <div class="menuPoint">
            <i class="fa fa-file-text-o" aria-hidden="true"></i><span> Страницы</span>
        </div>
    </a>
    <a href="/admin/text/">
        <div class="menuPoint">
            <i class="fa fa-font" aria-hidden="true"></i><span> Тексты</span>
        </div>
    </a>
    <a href="/admin/reviews/">
        <div class="menuPoint">
            <i class="fa fa-commenting-o" aria-hidden="true"></i><span> Отзывы</span>
        </div>
    </a>
    <a href="/admin/categories/">
        <div class="menuPoint">
            <i class="fa fa-bars" aria-hidden="true"></i><span> Разделы</span>
        </div>
    </a>
    <a href="/admin/goods/">
        <div class="menuPointActive">
            <i class="fa fa-shower" aria-hidden="true"></i><span> Товары</span>
        </div>
    </a>
    <a href="/admin/properties/">
        <div class="menuPoint">
            <i class="fa fa-check-square-o" aria-hidden="true"></i><span> Характеристики товаров</span>
        </div>
    </a>
    <a href="/admin/security/">
        <div class="menuPoint">
            <i class="fa fa-shield" aria-hidden="true"></i><span> Безопасность</span>
        </div>
    </a>
</div>

<div id="content">
    <span class="headerFont">Добавление товаров</span>
    <br /><br />
    <form method="post" enctype="multipart/form-data" id="goodForm" name="goodForm">
        <label for="categorySelect">Раздел:</label>
        <br />
        <select id="categorySelect" name="category" onchange="window.location = '?c=' + this.options[this.selectedIndex].value">
            <option value="">- Выберите раздел -</option>
            <?php
            $categoryResult = $mysqli->query("SELECT * FROM akvasan_categories ORDER BY name");
            while($category = $categoryResult->fetch_assoc()) {
                echo "<option value='".$category['id']."'"; if($_REQUEST['c'] == $category['id']) {echo " selected";} echo ">".$category['name']."</option>";
            }
            ?>
        </select>
        <?php
            if(!empty($_REQUEST['c'])) {
                echo "
                        <br /><br />
                        <label for='subcategorySelect'>Подраздел:</label>
                        <br />
                        <select id='subcategorySelect' name='subcategory' onchange='window.location = \"/admin/goods/add.php?c=".$_REQUEST['c']."&s=\" + this.options[this.selectedIndex].value'>
                            <option value=''>- Выберите подраздел -</option>
                        
                    ";

                $subcategoryResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE category_id = '".$mysqli->real_escape_string($_REQUEST['c'])."' ORDER BY name");
                while($subcategory = $subcategoryResult->fetch_assoc()) {
                    echo "<option value='".$subcategory['id']."'"; if($_REQUEST['s'] == $subcategory['id']) {echo " selected";} echo ">".$subcategory['name']."</option>";
                }

                echo "
                        </select>
                    ";
            }

            if(!empty($_REQUEST['s'])) {
                echo "
                    <br /><br />
                    <label for='nameInput'>Название товара:</label>
                    <br />
                    <input id='nameInput' name='name' />
                    <br /><br />
                    <label for='urlInput'>Идентификатор товара:</label>
                    <br />
                    <input id='urlInput' name='url' />
                    <br /><br />
                    <label for='previewInput'>Фотография товара:</label>
                    <br />
                    <input type='file' class='file' id='previewInput' name='preview' />
                    <br /><br />
                    <label for='additionalPhotosInput'>Дополнительный фотографии (не обязательно):</label>
                    <br />
                    <input type='file' class='file' id='additionalPhotosInput' name='additionalPhotos[]' multiple />
                    <br /><br />
                    <label for='priceInput'>Цена в белорусских рублях:</label>
                    <br />
                    <input type='number' id='priceInput' name='price' min='0.01' step='0.01' />
                    <br /><br />
                    <label for='codeInput'>Артикул:</label>
                    <br />
                    <input id='codeInput' name='code' value='" . $good['code'] . "' />
                    <br /><br />
                    <label for='leaderInput'>Отображать как лидер продаж?</label>
                    <input type='checkbox' id='leaderInput' name='leader' />
                    <br /><br />
                    <label for='textInput'>Краткое описание:</label>
                    <br />
                    <textarea id='textInput' name='text'></textarea>
                    <br /><br />
                    <span class='headerFont'>Характеристики товара</span>
                    <br /><br />
                    <table class='propertyTable'>
                ";

                $propertyResult = $mysqli->query("SELECT * FROM akvasan_properties ORDER BY name");
                while ($property = $propertyResult->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>
                                <label for='property" . $property['id'] . "'>" . $property['name'] . "</label>
                            </td>
                            <td style='padding-left: 20px; padding-right: 20px;'>
                                <input type='checkbox' class='checkbox' id='property" . $property['id'] . "' name='property" . $property['id'] . "' />
                            </td>
                            <td>
                                <input id='propertyInput" . $property['id'] . "' class='propertyInput' name='propertyInput" . $property['id'] . "' />
                            </td>
                        </tr>
                    ";
                }

                echo "
                    </table>
                    <br /><br />
                    <input type='button' class='button' id='addGoodSubmit' value='Добавить' onmouseover='buttonHover(\"addGoodSubmit\", 1)' onmouseout='buttonHover(\"addGoodSubmit\", 0)' onclick='addGood()' />
                ";
            }
        ?>
    </form>
</div>

<script type="text/javascript">
    CKEDITOR.replace("text");
</script>

</body>

</html>