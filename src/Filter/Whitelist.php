<?php

namespace Centum\Filter;

use Centum\Interfaces\Filter\FilterInterface;

class Whitelist implements FilterInterface
{
    /**
     * @param list<mixed> $whitelist
     */
    public function __construct(
        protected readonly array $whitelist,
        protected readonly bool $strict = true
    ) {
    }



    public function filter(mixed $value): mixed
    {
        if (!in_array($value, $this->whitelist, $this->strict)) {
            return null;
        }

        return $value;
    }
}
