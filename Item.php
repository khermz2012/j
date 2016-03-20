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

    public function allShirts($sf, $np)
    {
        $query = "SELECT * FROM shirts s INNER JOIN brand b WHERE s.brand_id = b.brand_id LIMIT $sf,$np";
        return $this->query($query);
    }

    public function countShirts()
    {
        $query = "SELECT * FROM shirts s INNER JOIN brand b WHERE s.brand_id = b.brand_id";
        $r = $this->query($query);
        $no = mysqli_num_rows($r);
        return $no;
    }

    public function allSkirts($sf, $np)
    {
        $query = "SELECT * FROM skirts s INNER JOIN brand b WHERE s.brand_id = b.brand_id  LIMIT $sf,$np";
        return $this->query($query);
    }

    public function countSkirts()
    {
        $query = "SELECT * FROM skirts s INNER JOIN brand b WHERE s.brand_id = b.brand_id";
        $r = $this->query($query);
        $no = mysqli_num_rows($r);
        return $no;
    }

    /**
     * @param $sf
     * @param $np
     * @return bool|mysqli_result
     */
    public function allBags($sf, $np)
    {
        $query = "SELECT * FROM bags bg INNER JOIN brand b WHERE bg.brand_id = b.brand_id LIMIT $sf,$np";
        return $this->query($query);
    }

    /**
     * @return int
     */
    public function countBags()
    {
        $query = "SELECT * FROM bags s INNER JOIN brand b WHERE s.brand_id = b.brand_id";
        $r = $this->query($query);
        $no = mysqli_num_rows($r);
        return $no;
    }

    public function allMakeUp($sf,$np)
    {
        $query = "SELECT * FROM make_up m INNER JOIN brand b WHERE m.brand_id = b.brand_id LIMIT $sf,$np";
        return $this->query($query);
    }

    public function countMakeUp()
    {
        $query = "SELECT * FROM make_up m INNER JOIN brand b WHERE m.brand_id = b.brand_id";
        $r = $this->query($query);
        $no = mysqli_num_rows($r);
        return $no;
    }
}