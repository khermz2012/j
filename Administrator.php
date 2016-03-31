<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/30/2016
 * Time: 10:42 PM
 */
include_once 'adb.php';
include_once 'Mail.php';

class Administrator extends Adb
{
    public function getAllClothes()
    {
        $query = "SELECT s.skirt_id, s.skirt_name,s.qty, s.price, b.brand_name from skirts s inner join brand b on s.brand_id = b.brand_id ORDER by s.price ASC";

        return $this->query($query);
    }

    public function update($name, $brand, $qty, $price, $id)
    {
        $query = "UPDATE skirts SET skirt_name=?,brand_id=?,qty=?,price=? WHERE skirt_id=?";
        $s = $this->prepare($query);
        $s->bind_param('siiii', $name, $brand, $qty, $price, $id);
        $s->execute();
    }

    public function orders()
    {
        $query = "SELECT o.order_id,o.date, c.email,c.address,c.country from orders o INNER JOIN customer c where o.cust_id = c.cust_id AND o.confirmed = 0";
        return $this->query($query);
    }

    public function getCustomerDetails($id){
        $query = "SELECT c.firstname,c.lastname,c.email,o.date from customer c inner join orders o WHERE c.cust_id = o.cust_id AND o.order_id=?";
        $s = $this->prepare($query);
        $s->bind_param('i',$id);
        $s->execute();
        return $s->get_result();
    }


    public function confirmOrder($id)
    {
        $query = "UPDATE orders SET confirmed = 1 WHERE order_id=?";
        $s = $this->prepare($query);
        $s->bind_param('i',$id);
        $s->execute();

    }
}