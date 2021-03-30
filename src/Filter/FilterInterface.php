<?php

namespace Centum\Filter;

interface FilterInterface
{
    public function filter(mixed $value): mixed;
}
