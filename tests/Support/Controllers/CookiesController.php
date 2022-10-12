<?php

namespace Tests\Support\Controllers;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\ResponseInterface;

class CookiesController
{
    public function index(): ResponseInterface
    {
        $cookies = new Cookies();

        $cookies->add(
            new Cookie("username", "SidRoberts")
        );

        return new Response(
            "content",
            Status::OK,
            null,
            $cookies
        );
    }
}
