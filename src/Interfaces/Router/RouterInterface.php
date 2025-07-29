<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;

interface RouterInterface
{
    /**
     * Make a new group of Routes with an optional middleware.
     */
    public function group(?MiddlewareInterface $middleware = null): GroupInterface;



    /**
     * @param class-string<ExceptionHandlerInterface> $exceptionHandlerClass
     */
    public function addExceptionHandler(string $exceptionHandlerClass): void;



    /**
     * Handle a Request object and convert into a Response object.
     */
    public function handle(RequestInterface $request): ResponseInterface;
}
