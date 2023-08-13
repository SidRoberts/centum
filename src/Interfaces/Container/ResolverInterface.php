<?php

namespace Centum\Interfaces\Container;

use ReflectionParameter;

interface ResolverInterface
{
    public function resolve(ReflectionParameter $parameter): mixed;
}
