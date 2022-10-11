<?php

namespace Centum\Filter;

use Centum\Interfaces\Filter\FilterInterface;

class Blacklist implements FilterInterface
{
    /**
     * @var array<mixed>
     */
    protected readonly array $blacklist;

    protected readonly bool $strict;



    /**
     * @param array<mixed> $blacklist
     */
    public function __construct(array $blacklist, bool $strict = true)
    {
        $this->blacklist = $blacklist;
        $this->strict    = $strict;
    }



    public function filter(mixed $value): mixed
    {
        if (in_array($value, $this->blacklist, $this->strict)) {
            return null;
        }

        return $value;
    }
}
