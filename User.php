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

    public function validate($username,$email){
        $query = "SELECT * FROM login WHERE username = ? AND email = ?";
        $s = $this->prepare($query);
        $s->bind_param('ss', $username,$email);
        $s->execute();
        return $s->get_result();
    }

    public function insert($username,$email,$password){
        $query = "INSERT INTO `login`(`username`, `email`, `password`) VALUES (?,?,?)";
        $s = $this->prepare($query);
        $s->bind_param('sss', $username,$email,$password);
        $s->execute();
//        return $s->get_result();
    }

}