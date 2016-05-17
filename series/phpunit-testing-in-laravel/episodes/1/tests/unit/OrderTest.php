<?php
use App\Order;
use App\Product;

/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 5/17/16
 */
class OrderTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function an_order_consists_of_products()
    {
        $order = new Order;

        $product = new Product('Fallout 4');
        $product2 = new Product('Fallout 3');

        $order->add($product);
        $order->add($product2);

        $this->assertCount(2, $order->products());

        $product3 = new Product('Fallout 2');
        $order->add($product3);

        $this->assertCount(3, $order->products());
    }
}