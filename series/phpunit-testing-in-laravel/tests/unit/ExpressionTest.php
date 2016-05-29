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
        $this->assertRegExp($regex, 'www');

        $regex = Expression::make()->then('www');
        $this->assertRegExp($regex, 'www');
    }

    /** @test */
    public function checks_for_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertRegExp($regex, 'foo');
    }

    /** @test */
    public function maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('http');
        $this->assertRegExp($regex, 'http');
        $this->assertRegExp($regex, '');
    }

    /** @test */
    public function chains_method_calls()
    {
    }
}