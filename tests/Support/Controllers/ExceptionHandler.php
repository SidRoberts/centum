<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ExceptionHandlerInterface;
use Throwable;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, Throwable $throwable): ResponseInterface
    {
        return new Response(
            "Internal server error",
            Status::INTERNAL_SERVER_ERROR
        );
    }
}
