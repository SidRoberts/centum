<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Http\Request;
use Centum\Interfaces\Http\ResponseInterface;

class LoginController
{
    public function form(): ResponseInterface
    {
        return new Response("login form");
    }

    public function submit(Request $request): ResponseInterface
    {
        return new Response("login successful");
    }
}
