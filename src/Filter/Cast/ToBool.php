<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;

/**
 * Filters any value to a boolean.
 */
class ToBool implements FilterInterface
{
    public function filter(mixed $value): bool
    {
        return (bool) $value;
    }
}
