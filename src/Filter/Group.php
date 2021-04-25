<?php

namespace Centum\Filter;

class Group
{
    /**
     * @var FilterInterface[]
     */
    protected array $filters = [];



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
            /**
             * @var mixed
             */
            $value = $filter->filter($value);
        }

        return $value;
    }
}