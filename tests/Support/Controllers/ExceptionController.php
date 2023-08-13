<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;
use InvalidArgumentException;

class ExceptionController implements ControllerInterface
{
    public function index(): ResponseInterface
    {
        throw new InvalidArgumentException();
    }



    public function pageNotFound(): ResponseInterface
    {
        return new Response(
            "Page not found",
            Status::NOT_FOUND
        );
    }

    public function internalServerError(): ResponseInterface
    {
        return new Response(
            "Internal server error",
            Status::INTERNAL_SERVER_ERROR
        );
    }
}
