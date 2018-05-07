<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 07.05.2018
 * Time: 12:17
 */

function calculatePrice($price) {
    $r = intval($price);
    $k = intval(($price - $r) * 100);

    if($k == 0) {
        $k = "00";
    } else {
        if(strlen($k) == 1) {
            $k = "0".$k;
        }
    }

    $price = $r." руб. ".$k." коп.";

    return $price;
}