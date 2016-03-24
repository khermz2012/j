<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/24/2016
 * Time: 10:05 PM
 */

include_once 'User.php';
include_once 'Item.php';

$item = new Item();
$email = "dan.poku@ashesi.edu.gh";

$row = $item->getCustomerEmail($email);
$cust_em = $row->fetch_array(MYSQLI_ASSOC);

//if customer does not exist
if (is_null($cust_em['email'])) {
    echo 'is empty';
} else {
    echo 'not null';
}