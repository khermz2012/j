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

    $row = $user->validate($new_username, $email);
    $details = $row->fetch_array(MYSQLI_ASSOC);

    //Empty string
    if (strlen($new_username) == 0 || strlen($email) == 0) {

        echo '<script type="text/javascript">';
        echo 'alert("Please sign-up");';
        echo '</script >';

        header('Location: login.php');
    } else {

        if ($details['username'] === $new_username && $details['email'] === $email) {
            $_SESSION['logged-in'] = true;
            $_SESSION['email'] = $email;
            header('Location: cart.php');
        } else {
            header('Location: login.php');
        }
    }
}
echo $twig->render('login.twig');