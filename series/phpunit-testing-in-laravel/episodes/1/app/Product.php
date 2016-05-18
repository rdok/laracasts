<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 5/16/16
 */

namespace App;


class Product
{
    private $name;
    private $price;

    public function __construct($name, $price = null)
    {
        $this->setName($name);
        $this->setPrice($price);
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
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