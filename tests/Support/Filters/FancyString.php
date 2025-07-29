<?php

namespace Tests\Support\Filters;

use Stringable;

final class FancyString implements Stringable
{
    public function __construct(
        protected readonly string $value
    ) {
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
