<?php

include_once 'User.php';
include_once 'render_config.php';

session_start();

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $country = $_POST['country'];
    $check = isset($_POST['receipt']) ? $_POST['receipt'] : '';

    $len_email = strlen($email);
    $len_firstname = strlen($firstname);
    $len_lastname = strlen($lastname);
    $len_address = strlen($address);
    $len_phone = strlen($phone);

    if ($len_email == 0 || $len_firstname == 0 || $len_lastname == 0 || $len_address == 0 || $len_phone == 0) {
        header('Location: checkout.php');
    } else {
        //transactions and updating database.
    }

    if ($check == 'y') {
        $_SESSION['address'] = $address;
//        header('Location: customerReceipt.php');
    }

}

echo $twig->render('terms.twig');