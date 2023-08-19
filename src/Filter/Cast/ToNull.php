<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;

/**
 * Filters any value to `null`.
 */
class ToNull implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        return null;
    }
}
