<?php

namespace Centum\Filter;

use Centum\Interfaces\Filter\FilterInterface;

/**
 * Filters out any values in a blacklist.
 */
class Blacklist implements FilterInterface
{
    /**
     * @param list<mixed> $blacklist
     */
    public function __construct(
        protected readonly array $blacklist,
        protected readonly bool $strict = true
    ) {
    }



    public function filter(mixed $value): mixed
    {
        if (in_array($value, $this->blacklist, $this->strict)) {
            return null;
        }

        return $value;
    }
}
