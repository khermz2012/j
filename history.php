<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/25/2016
 * Time: 12:49 AM
 */

include_once 'Item.php';
include_once 'render_config.php';

session_start();

$item = new Item();

$mail = isset($_SESSION['email']) ? $_SESSION['email'] : '';

//$mail = 'khermz2012@gmail.com';

$row = $item->getItemsBought($mail);
$cust_items = $row->fetch_array(MYSQLI_ASSOC);

$file = $cust_items['items_bought'];

if (!file_exists($file)) {
//    die("File not found");
    header('Location: ./error.html');
} else {
    $my_file = fopen($file, "r");//or die("Unable to open file!");
//
    while (!feof($my_file)) {

        $id = fgets($my_file) . '<br>';

        $r = $item->getSkirtDetails($id);
        $addSkirt = $r->fetch_array(MYSQLI_ASSOC);

        $array['bought'][$id] = [
            'item' => $addSkirt['skirt_id'],
            'skirt_name' => $addSkirt['skirt_name'],
            'brand_name' => $addSkirt['brand_name'],
            'pic' => $addSkirt['pic'],
            'price' => $addSkirt['price'],
        ];
    }
}
fclose($my_file);

//print_r($array['bought']);

echo $twig->render('history.twig', [
    'history' => $array['bought']
]);

