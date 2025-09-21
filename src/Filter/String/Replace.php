<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class Replace implements FilterInterface
{
    /**
     * @param list<string> $search
     * @param list<string> $replace
     */
    public function __construct(
        protected array $search,
        protected array $replace
    ) {
    }



    /**
     * @throws InvalidArgumentException
     */
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return str_replace($this->search, $this->replace, $value);
    }
}
