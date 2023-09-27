<?php

namespace Centum\Container;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Container\ParameterInterface;
use Centum\Interfaces\Container\ResolverGroupInterface;
use Centum\Interfaces\Container\ResolverInterface;

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
        $key = array_search($resolver, $this->resolvers, true);

        if ($key === false) {
            return;
        }

        unset($this->resolvers[$key]);
    }



    /**
     * @throws UnresolvableParameterException
     */
    public function resolve(ParameterInterface $parameter, ContainerInterface $container): mixed
    {
        foreach ($this->resolvers as $resolver) {
            try {
                return $resolver->resolve($parameter);
            } catch (UnresolvableParameterException) {
            }
        }

        if ($parameter->isObject()) {
            $class = $parameter->getType();

            $aliasManager   = $container->getAliasManager();
            $objectStorage  = $container->getObjectStorage();
            $serviceStorage = $container->getServiceStorage();

            if (!$objectStorage->has($class)) {
                $service = $serviceStorage->get($class);

                if ($service !== null) {
                    $object = $container->typehintService($service);
                } else {
                    $alias = $aliasManager->get($class);

                    $object = $container->typehintClass($alias);
                }

                $objectStorage->set($class, $object);
            }

            return $objectStorage->get($class);
        }

        if ($parameter->hasDefaultValue()) {
            return $parameter->getDefaultValue();
        }

        if ($parameter->allowsNull()) {
            return null;
        }

        throw new UnresolvableParameterException($parameter);
    }
}
