<?php

namespace Centum\Http\Exception;

use ReflectionParameter;

class ReflectionParameterTypeNotRecognisedException extends \Exception
{
    public function __construct(
        protected readonly ReflectionParameter $reflectionParameter
    ) {
        $type = $reflectionParameter->getType();

        parent::__construct(
            sprintf(
                "Parameter '%s' type (%s) not recognised.",
                $reflectionParameter->getName(),
                $type->getName()
            )
        );
    }



    public function getReflectionParameter(): ReflectionParameter
    {
        return $this->reflectionParameter;
    }
}
