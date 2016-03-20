<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/19/2016
 * Time: 1:25 AM
 */

include_once 'Item.php';
//include_once 'Admin.php';
include_once 'render_config.php';

$num_per_page_shirt = 3;
$num_per_page_skirt = 3;
$num_per_page_bag = 3;
$num_per_page_make_up = 3;

if (isset($_REQUEST['shirt'])) {
    $shirt = $_REQUEST['shirt'];
} else {
    $shirt = 1;
}

if (isset($_REQUEST['skirt'])) {
    $skirt = $_REQUEST['skirt'];
} else {
    $skirt = 1;
}

if (isset($_REQUEST['bag'])) {
    $bag = $_REQUEST['bag'];
} else {
    $bag = 1;
}

if (isset($_REQUEST['make_up'])) {
    $make_up = $_REQUEST['make_up'];
} else {
    $make_up = 1;
}

$sf_shirt = ($shirt - 1) * $num_per_page_shirt;
$sf_skirt = ($skirt - 1) * $num_per_page_skirt;
$sf_bag = ($bag - 1) * $num_per_page_bag;
$sf_make_up = ($make_up - 1) * $num_per_page_make_up;

$item = new Item();
//$admin = new User();

$shirts = $item->allShirts($sf_shirt, $num_per_page_shirt);
$skirts = $item->allSkirts($sf_skirt, $num_per_page_skirt);
$bags = $item->allBags($sf_bag, $num_per_page_bag);
$make_ups = $item->allMakeUp($sf_make_up, $num_per_page_make_up);

$total_num_rows_shirts = $item->countShirts();
$total_num_rows_skirts = $item->countSkirts();
$total_num_rows_bags = $item->countBags();
$total_num_rows_make_ups = $item->countMakeUp();

$total_shirts = $total_num_rows_shirts['shirt_id'];
$total_skirts = $total_num_rows_skirts['skirt_id'];
$total_bags = $total_num_rows_bags['bag_id'];
$total_make_ups = $total_num_rows_make_ups['make_up_id'];

$total_pages_shirt = ceil($total_num_rows_shirts / $num_per_page_shirt);
$total_pages_skirt = ceil($total_num_rows_skirts / $num_per_page_skirt);
$total_pages_bag = ceil($total_num_rows_bags / $num_per_page_bag);
$total_pages_make_up = ceil($total_num_rows_make_ups / $num_per_page_make_up);

$ar = $shirts->fetch_all(MYSQLI_ASSOC);
$as = $skirts->fetch_all(MYSQLI_ASSOC);
$ab = $bags->fetch_all(MYSQLI_ASSOC);
$am = $make_ups->fetch_all(MYSQLI_ASSOC);
//
$allShirts['shirts'] = $ar;
$allSkirts['skirts'] = $as;
$allBags['bags'] = $ab;
$allMakeUp['makeups'] = $am;
//
echo $twig->render('index.twig', [
    'shirts' => $ar,
    'skirts' => $as,
    'bags' => $ab,
    'makeups' => $am,
    'shirt' => $shirt,
    'skirt' => $skirt,
    'bag' => $bag,
    'make_up' => $make_up,
    'total_pages_shirt' => $total_pages_shirt,
    'total_pages_skirt' => $total_pages_skirt,
    'total_pages_bag' => $total_pages_bag,
    'total_pages_make_up' => $total_pages_make_up
]);
//}
//echo $twig->render('index.twig');