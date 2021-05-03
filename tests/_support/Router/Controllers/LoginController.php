<?php

namespace Tests\Router\Controllers;

use Centum\Http\Response;

class LoginController
{
    public function form(): Response
    {
        return new Response("login form");
    }

    public function submit(): Response
    {
        return new Response("login successful");
    }
}
