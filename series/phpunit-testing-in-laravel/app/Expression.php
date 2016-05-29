<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 5/29/16
 */

namespace App;


class Expression
{
    public static function make()
    {
        return new static;
    }

    public function anything()
    {
        return '/.*/';
    }

    public function then($string)
    {
        return $this->find($string);
    }

    public function find($string)
    {
        return "/$string/";
    }

    public function maybe($string)
    {
        return "/($string)?/";
    }
}