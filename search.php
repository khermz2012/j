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

//$_SESSION['logged-in'] = false;

$item = new Item();

if (isset($_GET['search'])) {

    $search = $_GET['search'];

    $skirts = $item->search($search);

    $as = $skirts->fetch_all(MYSQLI_ASSOC);

    $allSkirts['skirts'] = $as;

    echo $twig->render('index.twig', [

        'skirts' => $as,

    ]);
} else {
    header('Location: index.php');
}

