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

session_start();

$item = new Item();

$num_per_page_skirt = 6;

if (isset($_REQUEST['skirt'])) {
    $skirt = $_REQUEST['skirt'];
} else {
    $skirt = 1;
}

$sf_skirt = ($skirt - 1) * $num_per_page_skirt;

$skirts = $item->allSkirts($sf_skirt, $num_per_page_skirt);

$total_num_rows_skirts = $item->countSkirts();

$total_skirts = $total_num_rows_skirts['skirt_id'];

$total_pages_skirt = ceil($total_num_rows_skirts / $num_per_page_skirt);

$as = $skirts->fetch_all(MYSQLI_ASSOC);
//
$allSkirts['skirts'] = $as;
//
echo $twig->render('index.twig', [

    'skirts' => $as,
    'skirt' => $skirt,
    'total_pages_skirt' => $total_pages_skirt,
]);

//}
//echo $twig->render('index.twig');