<?php
use App\Product;

/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 5/16/16
 */
class ProductTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider productDataProvider
     * @param $product
     */
    public function a_product_has_name($product)
    {
        $product = new Product($product);

        $this->assertSame($product, $product->name());
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
}