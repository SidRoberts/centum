<?php

namespace Tests\Filters;

use Stringable;

class FancyString implements Stringable
{
    protected string $value;



    public function __construct(string $value)
    {
        $this->value = $value;
    }



    public function toArray(): array
    {
        return explode(" ", $this->value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
