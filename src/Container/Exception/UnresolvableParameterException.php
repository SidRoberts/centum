<?php

namespace Centum\Container\Exception;

class UnresolvableParameterException extends \Exception
{
    public function __construct(
        protected readonly string $name
    ) {
    }



    public function getName(): string
    {
        return $this->name;
    }
}
