<?php
use App\Order;
use App\Product;

/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
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
    }

    /**
     * @test
     * @dataProvider productsDataProvider
     * @param $products
     * @param $totalPrice
     */
    public function an_order_can_determine_the_total_costs_of_all_its_products($products, $totalPrice)
    {
        $order = new Order;

        $product = new Product($products['product1']['name'], $products['product1']['price']);
        $product2 = new Product($products['product2']['name'], $products['product2']['price']);

        $order->add($product);
        $order->add($product2);

        $this->assertSame($totalPrice, $order->total());
    }


    public function productsDataProvider()
    {
        return [
            [
                'products'   => [
                    'product1' => ['name' => 'Fallout 4', 'price' => 40],
                    'product2' => ['name' => 'Fallout 3', 'price' => 30]
                ],
                'totalPrice' => 70,
            ],
            [
                'products'   => [
                    'product1' => ['name' => 'Fallout 2', 'price' => 20],
                    'product2' => ['name' => 'Fallout 1', 'price' => 10]
                ],
                'totalPrice' => 30,
            ]
        ];
    }
}