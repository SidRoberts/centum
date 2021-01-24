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
        if (!$this->has($name)) {
            throw new \Exception(
                sprintf(
                    "Parameter not found (%s)",
                    $name
                )
            );
        }

        return $this->parameters[$name];
    }

    public function has(string $name) : bool
    {
        return isset($this->parameters[$name]);
    }



    public function toArray() : array
    {
        return $this->parameters;
    }
}
