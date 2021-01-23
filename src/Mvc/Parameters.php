<?php

namespace Centum\Mvc;

class Parameters
{
    protected array $parameters;



    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }




    public function get(string $name)
    {
        if (!isset($this->parameters[$name])) {
            throw new \Exception(
                sprintf(
                    "Parameter not found (%s)",
                    $name
                )
            );
        }

        return $this->parameters[$name];
    }
}
