<?php

include_once 'User.php';
include_once 'Item.php';
include_once 'Mail.php';
include_once 'render_config.php';

session_start();

if (isset($_POST['mail'])) {
    $email = trim($_POST['mail'], " ");
    $firstname = trim($_POST['firstname'], " ");
    $middlename = trim($_POST['middlename'], " ");
    $lastname = trim($_POST['lastname'], " ");
    $address = trim($_POST['address'], " ");
    $phone = trim($_POST['phone'], " ");
    $country = $_POST['country'];

    $len_email = strlen($email);
    $len_firstname = strlen($firstname);
    $len_lastname = strlen($lastname);
    $len_address = strlen($address);
    $len_phone = strlen($phone);

    $item = new Item();
    $mail = new Mail();
    $date = date('d/m/Y');

    if ($len_email == 0 || $len_firstname == 0 || $len_lastname == 0 || $len_address == 0 || $len_phone == 0) {

        header('Location: checkout.php');
    } else if ($len_email > 0 && $len_firstname > 0 && $len_lastname > 0 && $len_address > 0 && $len_phone > 0) {

        $_SESSION['address'] = $address;

        $row = $item->getCustomerEmail($email);
        $cust_em = $row->fetch_array(MYSQLI_ASSOC);

        //if customer does not exist
        if (is_null($cust_em['email'])) {

            $my_file = "./customer_history/" . "$email" . ".txt";

            foreach ($_SESSION['cart'] as $skirt_id => $details) {

                $id = $_SESSION['cart'][$skirt_id]['item'];
                $cart_qty = $_SESSION['cart'][$skirt_id]['quantity'];
                $item = new Item();
                $row = $item->getSkirtDetails($id);
                $ss = $row->fetch_array(MYSQLI_ASSOC);
                $new_qty = $ss['qty'] - $cart_qty;
                $new_num_bought = $ss['num_bought'] + $cart_qty;

                $data = $_SESSION['cart'][$skirt_id]['item'] . "\n";

                file_put_contents($my_file, $data, FILE_APPEND);
//
                $item->updateSkirt($id, $new_qty, $new_num_bought);
            }

            $row = $item->getCustomerEmail($email);
            $cust_details = $row->fetch_array(MYSQLI_ASSOC);

            $item->makeCustomer($firstname, $middlename, $lastname, $email, $address, $country, $phone, $my_file);

            $row1 = $item->getCustomerDetails($email);
            $ss1 = $row1->fetch_array(MYSQLI_ASSOC);
            $cid = $ss1['cust_id'];

            $item->makeOrder($cid, $date);
            $mail->sendAlertMail($firstname,$lastname,$email);

            header('Location: orders.php');
        } elseif (!is_null($cust_em['email']) && strcmp($cust_em['email'], $email) === 0) {
            $my_file1 = "./customer_history/" . "$email" . ".txt";

            foreach ($_SESSION['cart'] as $skirt_id => $details) {

                $id = $_SESSION['cart'][$skirt_id]['item'];
                $cart_qty = $_SESSION['cart'][$skirt_id]['quantity'];
                $item = new Item();
                $row = $item->getSkirtDetails($id);
                $ss = $row->fetch_array(MYSQLI_ASSOC);
                $new_qty = $ss['qty'] - $cart_qty;
                $new_num_bought = $ss['num_bought'] + $cart_qty;

                $data1 = $_SESSION['cart'][$skirt_id]['item'] . "\n";

                file_put_contents($my_file1, $data1, FILE_APPEND);

                $item->updateSkirt($id, $new_qty, $new_num_bought);
            }

            $row1 = $item->getCustomerDetails($email);
            $ss1 = $row1->fetch_array(MYSQLI_ASSOC);
            $cid = $ss1['cust_id'];

            $item->makeOrder($cid, $date);
            $mail->sendAlertMail($firstname,$lastname,$email);

            header('Location: orders.php');
        }
    }
}



