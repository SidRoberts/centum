<?php

namespace Tests\Mvc\Controllers;

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
