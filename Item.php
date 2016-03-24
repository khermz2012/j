<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/19/2016
 * Time: 3:09 AM
 */

include_once('adb.php');

class Item extends Adb
{
    /**
     * @param $sf
     * @param $np
     * @return bool|mysqli_result
     */
    public function allSkirts($sf, $np)
    {
        $query = "SELECT * FROM skirts s INNER JOIN brand b WHERE s.brand_id = b.brand_id  LIMIT $sf,$np";
        return $this->query($query);
    }

    /**
     * @return int
     */
    public function countSkirts()
    {
        $query = "SELECT * FROM skirts s INNER JOIN brand b WHERE s.brand_id = b.brand_id";
        $r = $this->query($query);
        $no = mysqli_num_rows($r);
        return $no;
    }

    public function getSkirtDetails($id)
    {
        $query = "SELECT * FROM skirts s INNER JOIN brand b WHERE s.brand_id = b.brand_id AND s.skirt_id = ?";
        $s = $this->prepare($query);
        $s->bind_param('i', $id);
        $s->execute();
        return $s->get_result();
    }

    public function updateSkirt($id, $qty)
    {
        $query = "UPDATE skirts SET qty=? WHERE skirt_id=?";
        $s = $this->prepare($query);
        $s->bind_param('ii', $qty, $id);
        $s->execute();
    }

    public function makeCustomer($f, $m, $l, $em, $a, $c, $p)
    {
        $query = "INSERT INTO customer(firstname, middlename, lastname, email, address, country, phone) VALUES (?,?,?,?,?,?,?)";
        $s = $this->prepare($query);
        $s->bind_param('sssssss', $f, $m, $l, $em, $a, $c, $p);
        $s->execute();
    }

    public function getCustomerDetails($email)
    {
        $query = "SELECT cust_id FROM customer WHERE email = ?";
        $s = $this->prepare($query);
        $s->bind_param('s', $email);
        $s->execute();
        return $s->get_result();
    }

    public function makeOrder($cid, $date, $items)
    {
        $query = "INSERT INTO orders(cust_id,date,items_bought) VALUES (?,?,?)";
        $s = $this->prepare($query);
        $s->bind_param('iss', $cid, $date, $items);
        $s->execute();
    }

}