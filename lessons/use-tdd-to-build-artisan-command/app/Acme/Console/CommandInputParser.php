<?php

namespace Acme\Console;

class CommandInputParser
{
    public function parse($path, $properties)
    {
        $segments = explode('\\', str_replace('/', '\\', $path));
        $className = array_pop($segments);
        $namespace = implode('\\', $segments);
        $properties = $this->parseProperties($properties);

        return new CommandInput($className, $namespace, $properties);
    }

    /**
     * @param $properties
     * @return array|mixed
     */
    private function parseProperties($properties)
    {
        return preg_split('/ ?, ?/', $properties, null, PREG_SPLIT_NO_EMPTY);
    }
}
