<?php

namespace Centum\Interfaces\Container;

interface ResolverGroupInterface
{
    public function add(ResolverInterface $resolver): void;

    public function remove(ResolverInterface $resolver): void;

    public function resolve(ParameterInterface $parameter, ContainerInterface $container): mixed;
}
