<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/22/2016
 * Time: 12:23 AM
 */

include_once 'Item.php';
include_once 'render_config.php';
include_once 'User.php';

session_start();

$user = new User();

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $new_username = trim($username, " ");
    $email = $_POST['email'];
    $password = $_POST['password'];

    $row = $user->validate($new_username, $email, $password);
    $details = $row->fetch_array(MYSQLI_ASSOC);

    //Empty string
    if (strlen($new_username) == 0 || strlen($email) == 0) {
        header('Location: login.php');
    } else {

        if ($details['username'] === $new_username && $details['email'] === $email && $details['password'] === $password) {
            $_SESSION['logged-in'] = true;
            $_SESSION['email'] = $email;
            header('Location: cart.php');
        } else {
            header('Location: login.php');
        }
    }
}
echo $twig->render('login.twig');