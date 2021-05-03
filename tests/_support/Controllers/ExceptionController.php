<?php

namespace Tests\Controllers;

use Centum\Http\Response;
use Centum\Http\Status;
use InvalidArgumentException;

class ExceptionController
{
    public function index(): Response
    {
        throw new InvalidArgumentException();
    }



    public function pageNotFound(): Response
    {
        return new Response(
            "Page not found",
            Status::NOT_FOUND
        );
    }

    public function internalServerError(): Response
    {
        return new Response(
            "Internal server error",
            Status::INTERNAL_SERVER_ERROR
        );
    }
}
