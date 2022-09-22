<?php

namespace Centum\Container\Exception;

class UnresolvableParameterException extends \Exception
{
    protected readonly string $name;



    public function __construct(string $name)
    {
        $this->name = $name;
    }



    public function getName(): string
    {
        return $this->name;
    }
}
