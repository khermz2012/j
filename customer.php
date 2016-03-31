<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 2/12/2016
 * Time: 7:47 PM
 */
include_once 'Item.php';
include_once 'User.php';
include_once 'Administrator.php';
include_once 'render_config.php';

session_start();

$admin = new Administrator();
$i = 0;

$wid = null;
$total = 0;

//$numPerPage = 10;

//if (isset($_REQUEST['page'])) {
//    $page = $_REQUEST['page'];
//} else {
//    $page = 1;
//}
//
//$start_from = ($page - 1) * $numPerPage;

$admin = new Administrator();

$all = $admin->orders();
//$allo = $item->getBrands();

//$totalNumRows = $item->countSkirts();
//$total_clothes = $totalNumRows['skirt_id'];
//
//$total_pages = ceil($totalNumRows / $numPerPage);

$ar = $all->fetch_all(MYSQLI_ASSOC);
//$ab = $allbrands->fetch_all(MYSQLI_ASSOC);


$allData['orders'] = $ar;
//$allB['brands'] = $ab;

/** @var array $data */
echo $twig->render('customer.twig', [
    'orders' => $ar,
//    'brands' => $ab,
//    'total_clothes' => $total_clothes,
//    'page' => $page,
//    'totalPages' => $total_pages
//        'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : '',
//        'total' => $total
]);

//print_r($_SESSION['cart']);
//unset($_SESSION['cart']);
//session_destroy();
