<?php

namespace Tests\Support\Filters;

use Stringable;

class FancyString implements Stringable
{
    protected readonly string $value;



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
