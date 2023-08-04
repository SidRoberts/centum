<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;

class LoginController
{
    public function form(): ResponseInterface
    {
        return new Response("login form");
    }

    public function submit(): ResponseInterface
    {
        return new Response("login successful");
    }
}
