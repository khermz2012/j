<?php

include_once 'render_config.php';

session_start();

echo $twig->render('orders.twig', [
    'email' => isset($_SESSION['email']) ? $_SESSION['email'] : ''
]);