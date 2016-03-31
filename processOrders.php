<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/31/2016
 * Time: 4:20 AM
 */

include_once 'Administrator.php';
include_once 'Mail.php';

$admin = new Administrator();
$mail = new Mail();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $admin->confirmOrder($id);

    $row = $admin->getCustomerDetails($id);
    $data = $row->fetch_array(MYSQLI_ASSOC);

    $f = $data['firstname'];
    $l = $data['lastname'];
    $e = $data['email'];
    $d = $data['date'];

    $mail->sendConfirmMail($f, $l, $e, $d);

    header('Location: customer.php');

}