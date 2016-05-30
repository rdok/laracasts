<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 5/29/16
 */

namespace tests\unit;


use App\Expression;

class ExpressionTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function finds_a_string()
    {
        $regex = Expression::make()->find('www');
        $this->assertTrue($regex->test('www'));

        $regex = Expression::make()->then('www');
        $this->assertTrue($regex->test('www'));

        $this->assertFalse($regex->test('aaa'));
    }

    /** @test */
    public function checks_for_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertTrue($regex->test('foo'));
    }

    /** @test */
    public function maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('http');
        $this->assertTrue($regex->test('http'));

        $this->assertTrue($regex->test(''));
    }

    /** @test */
    public function chains_method_calls()
    {
        $regex = Expression::make()->find('foo')->maybe('bar')->then('biz');

        $this->assertRegExp($regex, 'foobarbiz');
    }
}