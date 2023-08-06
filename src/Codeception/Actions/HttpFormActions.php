<?php

namespace Centum\Codeception\Actions;

use Centum\Http\FormBuilder;
use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FilesInterface;
use PHPUnit\Framework\Assert;
use Throwable;

trait HttpFormActions
{
    abstract public function grabContainer(): ContainerInterface;



    /**
     * @template T of object
     * @psalm-param class-string<T> $formClass
     * @psalm-return T
     */
    public function buildForm(string $formClass, DataInterface $data, FilesInterface $files = null): object
    {
        $container = $this->grabContainer();

        $request = new Request(
            "/",
            "GET",
            $data,
            null,
            null,
            $files
        );

        $formBuilder = new FormBuilder($container, $request);

        $form = $formBuilder->build($formClass);

        return $form;
    }



    /**
     * @param class-string $formClass
     */
    public function expectFormThrowable(Throwable $expectedThrowable, string $formClass, DataInterface $data, FilesInterface $files = null): void
    {
        $expectedThrowableClass = get_class($expectedThrowable);

        try {
            $this->buildForm($formClass, $data, $files);
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

            // Increment assertion counter.
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
