<?php

namespace Centum\Mvc;

class Parameters
{
    protected array $parameters = [];



    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }



    public function get(string $name, mixed $defaultValue = null) : mixed
    {
        return $this->parameters[$name] ?? $defaultValue;
    }
}
