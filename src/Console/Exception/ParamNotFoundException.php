<?php

namespace Centum\Console\Exception;

use OutOfRangeException;

class ParamNotFoundException extends OutOfRangeException
{
    protected string $key;



    public function __construct(string $key)
    {
        $this->key = $key;
    }



    public function getKey(): string
    {
        return $this->key;
    }
}
