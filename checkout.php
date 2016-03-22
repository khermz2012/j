<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/21/2016
 * Time: 10:57 PM
 */

include_once 'Item.php';
include_once 'render_config.php';

echo $twig->render('checkout.twig', [
//    'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : '',
//    'total' => $total
//    'skirt_brand_name' => $sk_details['brand_name'],
//    'skirt_price' => $sk_details['price'],
//    'skirt_qty' => $sk_details['qty'],
//    'skirt_pic' => $sk_details['pic']
]);