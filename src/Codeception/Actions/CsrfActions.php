<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Mockery\MockInterface;

/**
 * CSRF Actions
 */
trait CsrfActions
{
    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    abstract public function grabFromContainer(string $class): object;

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    abstract public function mockInContainer(string $class, callable $callable = null): object;



    /**
     * Grab the CSRF Generator from the Container.
     */
    public function grabCsrfGenerator(): GeneratorInterface
    {
        return $this->grabFromContainer(GeneratorInterface::class);
    }

    /**
     * Grab the CSRF Storage from the Container.
     */
    public function grabCsrfStorage(): StorageInterface
    {
        return $this->grabFromContainer(StorageInterface::class);
    }



    /**
     * Get the current CSRF value.
     */
    public function getCsrfValue(): string
    {
        $csrfStorage = $this->grabCsrfStorage();

        return $csrfStorage->get();
    }

    /**
     * Reset the CSRF value, forcing it to be regenerated the next time it is
     * needed.
     */
    public function resetCsrfValue(): void
    {
        $csrfStorage = $this->grabCsrfStorage();

        $csrfStorage->reset();
    }



    /**
     * Replace the CSRF Validator with a mock that simply returns `true` for
     * everything.
     */
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
