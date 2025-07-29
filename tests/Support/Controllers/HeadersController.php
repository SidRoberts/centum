<?php

namespace Tests\Support\Controllers;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

final class HeadersController implements ControllerInterface
{
    public function index(): ResponseInterface
    {
        $headers = new Headers(
            [
                new Header("Cache-Control", "max-age"),
            ]
        );

        return new Response(
            "content",
            Status::OK,
            $headers
        );
    }
}
