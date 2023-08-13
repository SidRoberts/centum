<?php

namespace Centum\Container\Exception;

use ReflectionParameter;

class UnresolvableParameterException extends \Exception
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
