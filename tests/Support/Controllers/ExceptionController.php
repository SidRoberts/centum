<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\ResponseInterface;
use InvalidArgumentException;

class ExceptionController
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
