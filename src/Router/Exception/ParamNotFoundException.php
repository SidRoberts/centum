<?php

namespace Centum\Router\Exception;

use OutOfRangeException;

class ParamNotFoundException extends OutOfRangeException
{
    public function __construct(
        protected readonly string $key
    ) {
    }



    public function getKey(): string
    {
        return $this->key;
    }
}
