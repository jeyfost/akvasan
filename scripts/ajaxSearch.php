<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 03.05.2018
 * Time: 17:05
 */

include("connect.php");

$query = $mysqli->real_escape_string($_POST['query']);

$searchResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE name LIKE '%".$query."%' OR code LIKE '%".$query."%' ORDER BY name LIMIT 0, 10");

echo "
    <span class='goodContainerPrice'>Результаты поиска:</span>
    <div class='searchClose'><i class='fa fa-times' aria-hidden='true' onclick='hideSearch()'></i></div>
";

if($searchResult->num_rows > 0) {
    while($search = $searchResult->fetch_assoc()) {
        $categoryResult = $mysqli->query("SELECT * FROM akvasan_categories WHERE id = '".$search['category']."'");
        $category = $categoryResult->fetch_assoc();

        $subcategoryResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE id = '".$search['subcategory']."'");
        $subcategory = $subcategoryResult->fetch_assoc();

        echo "
            <div class='row'>              
                <table class='searchTable'>
                    <tbody>
                        <tr>
                            <td class='searchPhoto'>
                                <a href='/img/catalogue/big/".$search['photo']."' class='lightview' data-lightview-options='skin: \"light\"'>
                                    <img src='/img/catalogue/preview/".$search['preview']."' />
                                </a>
                            </td>
                            <td class='searchDescription'>
                                <a href='/catalogue/".$category['url']."/".$subcategory['url']."/".$search['url']."'>".$search['name']."</a>
                                <br /><br />
                                <span>".calculatePrice($search['price'])."</span>
                                <br /><br />
                                <a href='/catalogue/".$category['url']."/".$subcategory['url']."/".$search['url']."'><div class='promoButton'>Подробнее</div></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        ";
    }
} else {
    echo "К сожалению, поиск не дал результатов.";
}