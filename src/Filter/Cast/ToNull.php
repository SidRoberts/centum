<?php

namespace Centum\Filter\Cast;

use Centum\Filter\FilterInterface;

class ToNull implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        return null;
    }
}
