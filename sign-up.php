<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/22/2016
 * Time: 1:10 PM
 */
include_once 'User.php';

//echo "sss";
$user = new User();
//
if (isset($_POST['new_username'])) {
    $username = $_POST['new_username'];
    $email = $_POST['new_address'];
    $password = $_POST['new_password'];

    $n_username = trim($username, " ");
    $n_email = trim($email, " ");

    if (strlen($n_username) == 0 || strlen($n_email) == 0 || strlen($password) == 0) {
        header('Location: login.php');
    }

    if (strlen($n_username) > 0 && strlen($n_email) > 0 && strlen($password) > 0) {
        $user->insert($n_username, $n_email, $password);
        header('Location: login.php');
    }
}