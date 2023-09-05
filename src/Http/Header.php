<?php

namespace Centum\Http;

use Centum\Interfaces\Http\HeaderInterface;

class Header implements HeaderInterface
{
    /**
     * @param non-empty-string $name
     */
    public function __construct(
        protected readonly string $name,
        protected readonly string $value
    ) {
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
            "%s: %s",
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
        return $this->getHeaderString() . "\r\n";
    }
}
