<?php

namespace Centum\Interfaces\Container;

interface ResolverInterface
{
    public function resolve(ParameterInterface $parameter): mixed;
}
