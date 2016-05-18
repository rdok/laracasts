<?php
use App\Product;

/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 5/16/16
 */
class ProductTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider productDataProvider
     * @param $productName
     */
    public function a_product_has_name($productName)
    {
        $product = new Product($productName);

        $this->assertSame($productName, $product->name());
    }

    /**
     * @test
     * @dataProvider productDataProvider
     * @param $productName
     * @param $productPrice
     */
    public function a_product_has_price($productName, $productPrice)
    {
        $product = new Product($productName);

        $product->setPrice($productPrice);

        $this->assertSame($productPrice, $product->price());
    }


    public function productDataProvider()
    {
        return [
            ['name' => 'Fallout 4', 'price' => 40],
            ['name' => 'Fallout 3', 'price' => 30],
            ['name' => 'Fallout 2', 'price' => 20],
            ['name' => 'Fallout 1', 'price' => 10]
        ];
    }

    /** @test */
    public function a_product_can_set_the_price_on_initialization()
    {
        $product = new Product('Fallout 4', 40);

        $this->assertSame(40, $product->price());
    }
}