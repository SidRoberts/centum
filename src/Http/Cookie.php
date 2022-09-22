<?php

namespace Centum\Http;

class Cookie
{
    protected readonly string $name;
    protected readonly string $value;



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



    public function getHeaderString(): string
    {
        return sprintf(
            "Set-Cookie: %s: %s",
            $this->name,
            $this->value
        );
    }



    public function send(): void
    {
        header(
            $this->getHeaderString(),
            false
        );
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
