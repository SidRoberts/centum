<?php

namespace Centum\Filter\String;

use Centum\Filter\FilterInterface;
use InvalidArgumentException;

class Replace implements FilterInterface
{
    /**
     * @var string[]
     */
    protected array $search;

    /**
     * @var string[]
     */
    protected array $replace;



    /**
     * @param array<string, string> $replacements
     */
    public function __construct(array $replacements)
    {
        $this->search  = array_keys($replacements);
        $this->replace = array_values($replacements);
    }



    public function filter(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }


        return str_replace($this->search, $this->replace, $value);
    }
}
