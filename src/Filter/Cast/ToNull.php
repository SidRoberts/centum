<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;

class ToNull implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        return null;
    }
}
