<?php

include_once 'User.php';
include_once 'Item.php';
include_once 'render_config.php';

session_start();


if (isset($_POST['email'])) {
    $email = trim($_POST['email'], " ");
    $firstname = trim($_POST['firstname'], " ");
    $middlename = trim($_POST['middlename'], " ");
    $lastname = trim($_POST['lastname'], " ");
    $address = trim($_POST['address'], " ");
    $phone = trim($_POST['phone'], " ");
    $country = $_POST['country'];
//    $check = isset($_POST['receipt']) ? $_POST['receipt'] : '';

    $len_email = strlen($email);
    $len_firstname = strlen($firstname);
    $len_lastname = strlen($lastname);
    $len_address = strlen($address);
    $len_phone = strlen($phone);

//    $myfile = "./customer_history/.'$email'.txt";
    $date = date('d/m/Y');
//
//    file_put_contents($myfile,$date,FILE_APPEND);

    if ($len_email == 0 || $len_firstname == 0 || $len_lastname == 0 || $len_address == 0 || $len_phone == 0) {
        header('Location: checkout.php');
    } else if ($len_email > 0 && $len_firstname > 0 && $len_lastname > 0 && $len_address > 0 && $len_phone > 0) {

        $_SESSION['address'] = $address;


        foreach ($_SESSION['cart'] as $skirt_id => $details) {

            $id = $_SESSION['cart'][$skirt_id]['item'];
            $cart_qty = $_SESSION['cart'][$skirt_id]['quantity'];
            $item = new Item();
            $row = $item->getSkirtDetails($id);
            $ss = $row->fetch_array(MYSQLI_ASSOC);
            $new_qty = $ss['qty'] - $cart_qty;
            $new_num_bought = $ss['num_bought'] + $cart_qty;

            $item->updateSkirt($id, $new_qty, $new_num_bought);
        }

        $row = $item->getCustomerEmail($email);
        $cust_details = $row->fetch_array(MYSQLI_ASSOC);

        $item->makeCustomer($firstname, $middlename, $lastname, $email, $address, $country, $phone, 'ttt');

        $row1 = $item->getCustomerDetails($email);
        $ss1 = $row1->fetch_array(MYSQLI_ASSOC);
        $cid = $ss1['cust_id'];
//        $date = date("d/m/Y");

        $item->makeOrder($cid, $date);

        header('Location: orders.php');
    }
}

