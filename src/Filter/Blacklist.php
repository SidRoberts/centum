<?php

namespace Centum\Filter;

class Blacklist implements FilterInterface
{
    protected array $blacklist;
    protected bool $strict;



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
