<?php

namespace Centum\Filter;

use Centum\Interfaces\Filter\FilterInterface;

class Whitelist implements FilterInterface
{
    /**
     * @var array<mixed>
     */
    protected readonly array $whitelist;

    protected readonly bool $strict;



    /**
     * @param array<mixed> $whitelist
     */
    public function __construct(array $whitelist, bool $strict = true)
    {
        $this->whitelist = $whitelist;
        $this->strict    = $strict;
    }



    public function filter(mixed $value): mixed
    {
        if (!in_array($value, $this->whitelist, $this->strict)) {
            return null;
        }

        return $value;
    }
}
