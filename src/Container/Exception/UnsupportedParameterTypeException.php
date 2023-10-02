<?php

namespace Centum\Container\Exception;

use Exception;
use ReflectionParameter;

class UnsupportedParameterTypeException extends Exception
{
    public function __construct(
        protected readonly ReflectionParameter $reflectionParameter
    ) {
    }



    public function getReflectionParameter(): ReflectionParameter
    {
        return $this->reflectionParameter;
    }
}
