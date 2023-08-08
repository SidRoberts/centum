<?php

namespace Centum\Codeception\Actions;

use Centum\Http\FormBuilder;
use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FilesInterface;
use Throwable;

trait HttpFormActions
{
    abstract public function grabContainer(): ContainerInterface;

    /**
     * @param Throwable|string $throwable
     */
    abstract public function expectThrowable($throwable, callable $callback): void;



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
        $this->expectThrowable(
            $expectedThrowable,
            function () use ($formClass, $data, $files): void {
                $this->buildForm($formClass, $data, $files);
            }
        );
    }
}
