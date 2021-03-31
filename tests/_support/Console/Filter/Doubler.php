<?php

namespace Tests\Console\Filter;

use Centum\Filter\FilterInterface;

class Doubler implements FilterInterface
{
    public function filter(mixed $value): int
    {
        $value = (int) $value;

        return ($value * 2);
    }
}
