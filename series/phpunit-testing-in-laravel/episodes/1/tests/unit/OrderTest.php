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

    /**
     * @test
     * @dataProvider productsDataProvider
     * @param $products
     */
    public function an_order_can_determine_the_total_costs_of_all_its_products($products)
    {
        $order = new Order;

        $product = new Product($products['product1']['name'], $products['product1']['price']);
        $product2 = new Product($products['product2']['name'], $products['product2']['price']);

        $order->add($product);
        $order->add($product2);

//        $expectedPrice = $product['product1']['price'] + $product
//        $this->assertSame(, $order->total());
    }

    public function productsDataProvider()
    {
        return [
            ['product1' => ['name' => 'Fallout 4', 'price' => 40], 'product2' => ['name' => 'Fallout 3', 'price' => 30]],
            ['product1' => ['name' => 'Fallout 2', 'price' => 20], 'product2' => ['name' => 'Fallout 1', 'price' => 10]],
        ];
    }
}