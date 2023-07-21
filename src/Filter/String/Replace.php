<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class Replace implements FilterInterface
{
    /**
     * @param string[] $search
     * @param string[] $replace
     */
    public function __construct(
        protected array $search,
        protected array $replace
    ) {
    }



    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return str_replace($this->search, $this->replace, $value);
    }
}
