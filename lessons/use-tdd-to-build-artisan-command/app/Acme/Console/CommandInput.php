<?php
/**
 * @author Rizart Dokollari <r.dokollari@linkwi.se>
 * @since 9/8/16
 */

namespace Acme\Console;


class CommandInput
{
    public $className;
    public $namespace;
    public $properties;

    /**
     * CommandInput constructor.
     * @param $className
     * @param $namespace
     * @param $properties
     */
    public function __construct($className, $namespace, $properties)
    {
        $this->className = $className;
        $this->namespace = $namespace;
        $this->properties = $properties;
    }
}