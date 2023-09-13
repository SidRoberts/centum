<?php

namespace Centum\Container\Exception;

use Centum\Interfaces\Container\ParameterInterface;

class UnresolvableParameterException extends \Exception
{
    public function __construct(
        protected readonly ParameterInterface $parameter
    ) {
    }



    public function getParameter(): ParameterInterface
    {
        return $this->parameter;
    }
}
