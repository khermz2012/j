<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/21/2016
 * Time: 9:29 PM
 */

session_start();

include_once 'Item.php';
include_once 'render_config.php';

$total = 0;
$item = new Item();

if (isset($_GET['id']) && isset($_GET['action'])) {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $id = $_GET['id'];

        switch ($action) {
            case'add':
                $_SESSION['cart'][$id]['quantity']++;
                $s = $item->getSkirtDetails($id);
                $addSkirt = $s->fetch_array(MYSQLI_ASSOC);

                $_SESSION['cart'][$id] = [
                    'item' => $addSkirt['skirt_id'],
                    'skirt_name' => $addSkirt['skirt_name'],
                    'brand_name' => $addSkirt['brand_name'],
                    'quantity' => $_SESSION['cart'][$id]['quantity'],
                    'pic' => $addSkirt['pic'],
                    'price' => $addSkirt['price'],
                    'total' => $addSkirt['price'] * $_SESSION['cart'][$id]['quantity']
                ];
                break;

            case 'sub':
                $_SESSION['cart'][$id]['quantity']--;
                $s = $item->getSkirtDetails($id);
                $addSkirt = $s->fetch_array(MYSQLI_ASSOC);

                $_SESSION['cart'][$id] = [
                    'item' => $addSkirt['skirt_id'],
                    'skirt_name' => $addSkirt['skirt_name'],
                    'brand_name' => $addSkirt['brand_name'],
                    'quantity' => $_SESSION['cart'][$id]['quantity'],
                    'pic' => $addSkirt['pic'],
                    'price' => $addSkirt['price'],
                    'total' => $addSkirt['price'] * $_SESSION['cart'][$id]['quantity']
                ];

                if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                    unset($_SESSION['cart'][$id]);
                }
                break;

            case 'del':
                unset($_SESSION['cart'][$id]);
                break;

            case 'cc':
                unset($_SESSION['cart']);
                break;
        }
    }
}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

    foreach ($_SESSION['cart'] as $skirt_id => $details) {
        $total += $_SESSION['cart'][$skirt_id]['total'];
    }
}

//
echo $twig->render('cart.twig', [
    'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : '',
    'total' => $total
//    'skirt_brand_name' => $sk_details['brand_name'],
//    'skirt_price' => $sk_details['price'],
//    'skirt_qty' => $sk_details['qty'],
//    'skirt_pic' => $sk_details['pic']
]);