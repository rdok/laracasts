<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
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
        return $this->add('.*');
    }

    public function add($expression)
    {
        $this->expression .= "$expression";

        return $this;
    }

    public function then($value)
    {
        return $this->find($value);
    }

    public function find($value)
    {
        return $this->add($this->sanitize($value));
    }

    protected function sanitize($value)
    {
        $value = preg_quote($value, '/');

        return $value;
    }

    public function maybe($value)
    {
        $value = $this->sanitize($value);

        return $this->add("(?:$value)?");
    }

    public function anythingBut($value)
    {
        $value = $this->sanitize($value);

        return $this->add("(?!$value).*?");
    }

    public function __toString()
    {
        return $this->getRegex();
    }

    private function getRegex()
    {
        return "/{$this->expression}/";
    }

    public function test($value)
    {
        return (bool)preg_match((string)$this, $value);
    }
}