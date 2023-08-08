<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Filter\FilterInterface;
use PHPUnit\Framework\Assert;
use Throwable;

trait FilterActions
{
    public function expectFilterOutput(FilterInterface $filter, mixed $input, mixed $output): void
    {
        /** @var mixed */
        $value = $filter->filter($input);

        Assert::assertEquals($output, $value);
    }

    public function expectFilterThrowable(Throwable $expectedThrowable, FilterInterface $filter, mixed $input): void
    {
        $expectedThrowableClass = get_class($expectedThrowable);

        try {
            $filter->filter($input);
        } catch (Throwable $throwable) {
            if (!($throwable instanceof $expectedThrowableClass)) {
                Assert::fail(
                    sprintf(
                        "Exception of class '%s' expected to be thrown, but class '%s' was caught",
                        $expectedThrowableClass,
                        get_class($throwable)
                    )
                );
            }

            if ($expectedThrowable->getMessage() !== null && $expectedThrowable->getMessage() !== $throwable->getMessage()) {
                Assert::fail(
                    sprintf(
                        "Exception of class '%s' expected to have message '%s', but actual message was '%s'",
                        $expectedThrowableClass,
                        $expectedThrowable->getMessage(),
                        $throwable->getMessage()
                    )
                );
            }

            if ($expectedThrowable->getCode() !== null && $expectedThrowable->getCode() !== $throwable->getCode()) {
                Assert::fail(
                    sprintf(
                        "Exception of class '%s' expected to have code '%s', but actual code was '%s'",
                        $expectedThrowableClass,
                        $expectedThrowable->getCode(),
                        $throwable->getCode()
                    )
                );
            }

            // increment assertion counter
            Assert::assertTrue(true);

            return;
        }

        Assert::fail(
            sprintf(
                "Expected throwable of class '%s' to be thrown, but nothing was caught",
                $expectedThrowableClass
            )
        );
    }
}
