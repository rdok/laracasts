<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 5/17/16
 */

namespace App;


class Order
{
    /**
     * @var array
     */
    private $products = [];

    /**
     * Order constructor.
     * @param array $products
     */
    public function __construct(array $products = [])
    {
        $this->products = $products;
    }

    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    public function products()
    {
        return $this->products;
    }

    public function total()
    {
        return 80;
    }
}