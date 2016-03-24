<?php

include_once 'Item.php';
include_once 'User.php';

$item = new Item();
$user = new User();

if (isset($_POST['email'])) {

    $email = trim($_POST['email']);
    $old_password = $_POST['op'];
    $new_password = $_POST['np'];

    $len_email = strlen($email);
    $len_op = strlen($old_password);
    $len_np = strlen($new_password);

    if ($len_email == 0 || $len_op === 0 || $len_np === 0) {
        header('Location: profile.php');
    } else {
        $row = $user->getUserDetails($email, $old_password);
        $details = $row->fetch_array(MYSQLI_ASSOC);

        if ($email === $details['email'] && $old_password === $details['password']) {
            $user->updatePassword($email,$old_password,$new_password);
            header('Location: login.php');
        }
        else{
            header('Location: profile.php');
        }
    }
}