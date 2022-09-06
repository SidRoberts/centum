<?php

namespace Tests\Controllers;

use Centum\Http\Response;
use Centum\Http\Request;

class LoginController
{
    public function form(): Response
    {
        return new Response("login form");
    }

    public function submit(Request $request): Response
    {
        return new Response("login successful");
    }
}
