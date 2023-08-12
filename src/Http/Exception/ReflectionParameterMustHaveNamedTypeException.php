<?php

namespace Centum\Http\Exception;

use ReflectionParameter;

class ReflectionParameterMustHaveNamedTypeException extends \Exception
{
    public function __construct(
        protected readonly ReflectionParameter $reflectionParameter
    ) {
        parent::__construct(
            sprintf(
                "Parameter '%s' must have a simple named type.",
                $reflectionParameter->getName()
            )
        );
    }



    public function getReflectionParameter(): ReflectionParameter
    {
        return $this->reflectionParameter;
    }
}
