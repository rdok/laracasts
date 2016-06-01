<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
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
        $regex = Expression::make()->find('www')->maybe('.')->then('laracasts');

        $this->assertTrue($regex->test('www.laracasts'));
        $this->assertFalse($regex->test('wwwXlaracasts'));
    }

    /** @test */
    public function exclude_values()
    {
        $regex = Expression::make()
            ->find('foo')
            ->anythingBut('bar')
            ->then('biz');

        $this->assertTrue($regex->test('foobazbiz'));
        $this->assertFalse($regex->test('foobarbiz'));
        $this->assertTrue($regex->test('foobiz'));
    }
}