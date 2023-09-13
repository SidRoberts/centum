<?php

namespace Centum\Container;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Container\ResolverGroupInterface;
use Centum\Interfaces\Container\ResolverInterface;
use ReflectionNamedType;
use ReflectionParameter;

class ResolverGroup implements ResolverGroupInterface
{
    /**
     * @var array<ResolverInterface>
     */
    protected array $resolvers = [];



    public function add(ResolverInterface $resolver): void
    {
        $this->resolvers[] = $resolver;
    }



    public function remove(ResolverInterface $resolver): void
    {
        $key = array_search($resolver, $this->resolvers);

        if ($key === false) {
            return;
        }

        unset($this->resolvers[$key]);
    }



    /**
     * @throws UnresolvableParameterException
     */
    public function resolve(ReflectionParameter $parameter, ContainerInterface $container): mixed
    {
        foreach ($this->resolvers as $resolver) {
            try {
                return $resolver->resolve($parameter);
            } catch (UnresolvableParameterException) {
            }
        }

        $type = $parameter->getType();

        if ($type === null && $parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        if (!($type instanceof ReflectionNamedType)) {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$type->isBuiltIn()) {
            $class = $type->getName();

            return $container->get($class);
        }

        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        if ($parameter->allowsNull()) {
            return null;
        }

        throw new UnresolvableParameterException($parameter);
    }
}
