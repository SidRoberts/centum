<?php

namespace Centum\Console\Exception;

use ReflectionParameter;

class ParameterMustHaveSimpleTypeException extends \Exception
{
    public function __construct(
        protected readonly ReflectionParameter $parameter
    ) {
        parent::__construct(
            sprintf(
                "Parameter '%s' must have a simple named type.",
                $parameter->getName()
            )
        );
    }



    public function getParameter(): ReflectionParameter
    {
        return $this->parameter;
    }
}
