<?php

namespace Tests\Support\Controllers;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\ResponseInterface;

class HeadersController
{
    public function index(): ResponseInterface
    {
        $headers = new Headers();

        $headers->add(
            new Header("Cache-Control", "max-age")
        );

        return new Response(
            "content",
            Status::OK,
            $headers
        );
    }
}
