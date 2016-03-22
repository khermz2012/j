<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/20/2016
 * Time: 3:47 PM
 */
session_start();

include_once 'Item.php';
include_once 'render_config.php';

$item = new Item();
$sk_id = null;
$total = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $skirt = $item->getSkirtDetails($id);
    $sk_details = $skirt->fetch_array(MYSQLI_ASSOC);


    if (isset($_GET['action'])) {
        $sk_id = $_GET['id'];
//    $action = $_GET['action'];

        if (!isset($_SESSION['cart'][$sk_id])) {
            $sk_d = $item->getSkirtDetails($sk_id);
            $addSkirt = $sk_d->fetch_array(MYSQLI_ASSOC);

            $_SESSION['cart'][$sk_id] = [
                'item' => $addSkirt['skirt_id'],
                'skirt_name' => $addSkirt['skirt_name'],
                'brand_name' => $addSkirt['brand_name'],
                'quantity' => 1,
                'pic' => $addSkirt['pic'],
                'price' => $addSkirt['price'],
                'total' => $addSkirt['price']
            ];

            header('Location: index.php');
        }
    }
}
//print_r($_SESSION['cart']);

echo $twig->render('product-details.twig', [
    'skirt_name' => $sk_details['skirt_name'],
    'skirt_id' => $sk_details['skirt_id'],
    'skirt_brand_name' => $sk_details['brand_name'],
    'skirt_price' => $sk_details['price'],
    'skirt_qty' => $sk_details['qty'],
    'skirt_pic' => $sk_details['pic']
]);