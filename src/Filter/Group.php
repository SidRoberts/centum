<?php

namespace Centum\Filter;

use Centum\Interfaces\Filter\FilterInterface;

class Group implements FilterInterface
{
    /** @var array<FilterInterface> */
    protected array $filters = [];



    /**
     * @return array<FilterInterface>
     */
    public function getFilters(): array
    {
        return $this->filters;
    }



    public function addFilter(FilterInterface $filter): void
    {
        $this->filters[] = $filter;
    }



    public function filter(mixed $value): mixed
    {
        // Apply filters to value.
        foreach ($this->filters as $filter) {
            /** @var mixed */
            $value = $filter->filter($value);
        }

        return $value;
    }
}
