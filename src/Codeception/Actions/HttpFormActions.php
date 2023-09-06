<?php

namespace Centum\Codeception\Actions;

use Centum\Container\Resolver\FormResolver;
use Centum\Container\Resolver\RequestResolver;
use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FilesInterface;
use Centum\Interfaces\Http\FormInterface;
use Throwable;

/**
 * HTTP Form Actions
 */
trait HttpFormActions
{
    abstract public function grabContainer(): ContainerInterface;

    /**
     * @param Throwable|string $throwable
     */
    abstract public function expectThrowable($throwable, callable $callback): void;



    /**
     * @template T of FormInterface
     *
     * @param class-string<T> $formClass
     *
     * @return T
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



        $resolverGroup = $container->getResolverGroup();

        $requestResolver = new RequestResolver($request);
        $formResolver    = new FormResolver($data);

        $resolverGroup->add($requestResolver);
        $resolverGroup->add($formResolver);



        $form = $container->get($formClass);



        $resolverGroup->remove($requestResolver);
        $resolverGroup->remove($formResolver);



        return $form;
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
