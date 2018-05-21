<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 21.05.2018
 * Time: 16:38
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$subcategoriesCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_subcategories WHERE category_id = '".$id."'");
$subcategoriesCheck = $subcategoriesCheckResult->fetch_array(MYSQLI_NUM);

if($subcategoriesCheck[0] > 0) {
    $goodsCheckResult = $mysqli->query("SELECT COUNT(id) FROM akvasan_catalogue WHERE category = '".$id."'");
    $goodsCheck = $goodsCheckResult->fetch_array(MYSQLI_NUM);

    if($goodsCheck[0] > 0) {
        $goodResult = $mysqli->query("SELECT * FROM akvasan_catalogue WHERE category = '".$id."'");
        while ($good = $goodResult->fetch_assoc()) {
            if($mysqli->query("DELETE FROM akvasan_catalogue WHERE id = '".$good['id']."'")) {
                $photoResult = $mysqli->query("SELECT * FROM akvasan_photos WHERE good_id = '".$good['id']."'");
                while($photo = $photoResult->fetch_assoc()) {
                    unlink("../../../img/catalogue/all/".$photo['photo']);
                }

                unlink("../../../img/catalogue/big/".$good['photo']);
                unlink("../../../img/catalogue/preview/".$good['preview']);
            }
        }

        $subcategoryResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE category_id = '".$id."'");
        while($subcategory = $subcategoryResult->fetch_assoc()) {
            $mysqli->query("DELETE FROM akvasan_subcategories WHERE id = '".$subcategory['id']."'");
        }

        if($mysqli->query("DELETE FROM akvasan_categories WHERE id = '".$id."'")) {
            echo "ok";
        } else {
            echo "failed";
        }
    } else {
        $subcategoryResult = $mysqli->query("SELECT * FROM akvasan_subcategories WHERE category_id = '".$id."'");
        while($subcategory = $subcategoryResult->fetch_assoc()) {
            $mysqli->query("DELETE FROM akvasan_subcategories WHERE id = '".$subcategory['id']."'");
        }

        if($mysqli->query("DELETE FROM akvasan_categories WHERE id = '".$id."'")) {
            echo "ok";
        } else {
            echo "failed";
        }
    }
} else {
    if($mysqli->query("DELETE FROM akvasan_categories WHERE id = '".$id."'")) {
        echo "ok";
    } else {
        echo "failed";
    }
}