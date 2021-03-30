<?php

namespace Centum\Http;

class Cookie
{
    protected string $name;
    protected string $value;



    public function __construct(string $name, string $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }



    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }



    public function __toString(): string
    {
        return sprintf(
            "%s: %s\r\n",
            $this->name,
            $this->value
        );
    }
}
