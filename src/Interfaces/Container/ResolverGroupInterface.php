<?php

namespace Centum\Interfaces\Container;

use ReflectionParameter;

interface ResolverGroupInterface
{
    public function add(ResolverInterface $resolver): void;

    public function remove(ResolverInterface $resolver): void;

    public function resolve(ReflectionParameter $parameter, ContainerInterface $container): mixed;
}
