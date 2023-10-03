<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ExceptionHandlerInterface;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Exception\UnsuitableExceptionHandlerException;
use Throwable;

class RouteNotFoundExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, Throwable $throwable): ResponseInterface
    {
        if (!($throwable instanceof RouteNotFoundException)) {
            throw new UnsuitableExceptionHandlerException($this);
        }

        return new Response(
            "Page not found",
            Status::NOT_FOUND
        );
    }
}
