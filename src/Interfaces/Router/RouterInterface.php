<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;

interface RouterInterface
{
    public function group(MiddlewareInterface $middleware = null): GroupInterface;



    /**
     * @param class-string $exceptionClass
     * @param class-string $class
     */
    public function addExceptionHandler(string $exceptionClass, string $class, string $method): void;



    public function handle(RequestInterface $request): ResponseInterface;
}
