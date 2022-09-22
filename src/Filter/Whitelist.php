<?php

namespace Centum\Filter;

class Whitelist implements FilterInterface
{
    protected readonly array $whitelist;
    protected readonly bool $strict;



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
