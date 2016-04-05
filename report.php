<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/19/2016
 * Time: 1:25 AM
 */

include_once 'Item.php';
include_once 'Administrator.php';
include_once 'render_config.php';

session_start();

$admin = new Administrator();

$skirts = $admin->report();

$as = $skirts->fetch_all(MYSQLI_ASSOC);

$allSkirts['reports'] = $as;

echo $twig->render('report.twig', [

    'reports' => $as,
]);

//}
//echo $twig->render('index.twig');