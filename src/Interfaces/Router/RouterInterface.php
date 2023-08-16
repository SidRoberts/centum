<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;

interface RouterInterface
{
    public function group(MiddlewareInterface $middleware = null): GroupInterface;



    /**
     * @param class-string $exceptionHandlerClass
     */
    public function addExceptionHandler(string $exceptionHandlerClass): void;



    public function handle(RequestInterface $request): ResponseInterface;
}
