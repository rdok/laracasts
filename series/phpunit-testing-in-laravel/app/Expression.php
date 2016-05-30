<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 5/29/16
 */

namespace App;


class Expression
{
    protected $expression;

    public static function make()
    {
        return new static;
    }

    public function anything()
    {
        $this->setExpression('.*');

        return $this;
    }

    /**
     * @param mixed $expression
     */
    public function setExpression($expression)
    {
        $this->expression = "/$expression/";
    }

    public function then($string)
    {
        return $this->find($string);
    }

    public function find($string)
    {
        $this->setExpression($string);

        return $this;
    }

    public function maybe($string)
    {
        $this->setExpression("($string)?");

        return $this;
    }

    public function __toString()
    {
        return $this->expression;
    }

    public function test($string)
    {
        return (bool)preg_match($this->expression, $string);
    }
}