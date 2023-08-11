<?php

namespace Centum\Console\Exception;

use ReflectionParameter;

class ParameterNotRecognisedException extends \Exception
{
    public function __construct(
        protected readonly ReflectionParameter $parameter
    ) {
        parent::__construct(
            sprintf(
                "Parameter '%s' type not recognised.",
                $parameter->getName()
            )
        );
    }



    public function getParameter(): ReflectionParameter
    {
        return $this->parameter;
    }
}
