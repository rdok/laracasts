<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 5/16/16
 */

namespace App;


class Product
{
    private $name;
    private $price;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function price()
    {
        return $this->price;
    }
}