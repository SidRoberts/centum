<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Container\ObjectStorageInterface;

/**
 * Container Actions
 */
trait ContainerActions
{
    abstract public function grabContainer(): ContainerInterface;

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    abstract public function mock(string $class, ?callable $callable = null): object;



    public function grabContainerObjectStorage(): ObjectStorageInterface
    {
        $container = $this->grabContainer();

        return $container->getObjectStorage();
    }



    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    public function grabFromContainer(string $class): object
    {
        $container = $this->grabContainer();

        return $container->get($class);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     * @param T               $object
     */
    public function addToContainer(string $class, object $object): void
    {
        $objectStorage = $this->grabContainerObjectStorage();

        $objectStorage->set($class, $object);
    }

    /**
     * Remove an object from the Container.
     *
     * @param class-string $class
     */
    public function removeFromContainer(string $class): void
    {
        $objectStorage = $this->grabContainerObjectStorage();

        $objectStorage->remove($class);
    }



    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    public function mockInContainer(string $class, ?callable $callable = null): object
    {
        $mock = $this->mock($class, $callable);

        $this->addToContainer($class, $mock);

        return $mock;
    }
}
