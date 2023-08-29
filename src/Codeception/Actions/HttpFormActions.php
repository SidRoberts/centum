<?php

namespace Centum\Codeception\Actions;

use Centum\Container\FormResolver;
use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FilesInterface;
use Centum\Interfaces\Http\FormInterface;
use Centum\Interfaces\Http\RequestInterface;
use Throwable;

trait HttpFormActions
{
    abstract public function grabContainer(): ContainerInterface;

    /**
     * @param Throwable|string $throwable
     */
    abstract public function expectThrowable($throwable, callable $callback): void;



    /**
     * @template T of FormInterface
     * @psalm-param class-string<T> $formClass
     * @psalm-return T
     */
    public function buildForm(string $formClass, DataInterface $data, FilesInterface $files = null): object
    {
        $container = $this->grabContainer();

        $request = new Request(
            "/",
            Method::GET,
            $data,
            null,
            null,
            $files
        );

        $container->set(RequestInterface::class, $request);

        $container->addResolver(
            new FormResolver($request)
        );

        return $container->get($formClass);
    }



    /**
     * @param Throwable|string $expectedThrowable
     * @param class-string<FormInterface> $formClass
     */
    public function expectFormThrowable($expectedThrowable, string $formClass, DataInterface $data, FilesInterface $files = null): void
    {
        $this->expectThrowable(
            $expectedThrowable,
            function () use ($formClass, $data, $files): void {
                $this->buildForm($formClass, $data, $files);
            }
        );
    }
}
