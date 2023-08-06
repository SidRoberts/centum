<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Mockery\MockInterface;

trait CsrfActions
{
    abstract public function grabContainer(): ContainerInterface;

    /**
     * @template T of object
     * @psalm-param interface-string<T>|class-string<T> $class
     * @psalm-return T
     */
    abstract public function mockInContainer(string $class, callable $callable = null): object;



    public function grabCsrfGenerator(): GeneratorInterface
    {
        $container = $this->grabContainer();

        return $container->get(GeneratorInterface::class);
    }

    public function grabCsrfStorage(): StorageInterface
    {
        $container = $this->grabContainer();

        return $container->get(StorageInterface::class);
    }



    public function getCsrfValue(): string
    {
        $csrfStorage = $this->grabCsrfStorage();

        return $csrfStorage->get();
    }

    public function resetCsrfValue(): void
    {
        $csrfStorage = $this->grabCsrfStorage();

        $csrfStorage->reset();
    }



    public function assumeCsrfIsValid(): void
    {
        $this->mockInContainer(
            ValidatorInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("validate")
                    ->zeroOrMoreTimes();
            }
        );
    }
}
