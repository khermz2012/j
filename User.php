<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/22/2016
 * Time: 1:12 AM
 */

include_once('adb.php');

class User extends Adb
{

    public function validate($username, $email, $password)
    {
        $query = "SELECT * FROM login WHERE username = ? AND email = ? AND password=?";
        $s = $this->prepare($query);
        $s->bind_param('sss', $username, $email, $password);
        $s->execute();
        return $s->get_result();
    }

    public function insert($username, $email, $password)
    {
        $query = "INSERT INTO `login`(`username`, `email`, `password`) VALUES (?,?,?)";
        $s = $this->prepare($query);
        $s->bind_param('sss', $username, $email, $password);
        $s->execute();
//        return $s->get_result();
    }

    public function writeToFile($file)
    {

    }

    public function getUserDetails($email, $password)
    {
        $query = "SELECT * FROM login WHERE email =? AND password=?";
        $s = $this->prepare($query);
        $s->bind_param('ss', $email, $password);
        $s->execute();
        return $s->get_result();
    }

    public function getEmail($email)
    {
        $query = "SELECT * FROM login WHERE email =?";
        $s = $this->prepare($query);
        $s->bind_param('s', $email);
        $s->execute();
        return $s->get_result();
    }

    public function updatePassword($email, $old_password, $new_password)
    {
        $query = "UPDATE login SET `password`=? WHERE email=? AND  password=?";
        $s = $this->prepare($query);
        $s->bind_param('sss', $new_password, $email, $old_password);
        $s->execute();
    }
}