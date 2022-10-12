<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class Replace implements FilterInterface
{
    /** @var string[] */
    protected array $search;

    /** @var string[] */
    protected array $replace;



    /**
     * @param string[] $search
     * @param string[] $replace
     */
    public function __construct(array $search, array $replace)
    {
        $this->search  = $search;
        $this->replace = $replace;
    }



    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return str_replace($this->search, $this->replace, $value);
    }
}
