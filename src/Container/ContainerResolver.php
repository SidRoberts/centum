<?php

namespace Centum\Container;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Container\ResolverInterface;
use ReflectionNamedType;
use ReflectionParameter;

class ContainerResolver implements ResolverInterface
{
    public function __construct(
        protected readonly ContainerInterface $container
    ) {
    }



    public function resolve(ReflectionParameter $parameter): mixed
    {
        $type = $parameter->getType();

        if ($type === null && $parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        if (!($type instanceof ReflectionNamedType)) {
            throw new UnresolvableParameterException($parameter);
        }

        if ($type->isBuiltIn()) {
            throw new UnresolvableParameterException($parameter);
        }

        $class = $type->getName();

        return $this->container->get($class);
    }
}
