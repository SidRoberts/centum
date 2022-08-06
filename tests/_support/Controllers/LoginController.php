<?php

namespace Tests\Controllers;

use Centum\Http\Response;
use Centum\Http\FormRequest;

class LoginController
{
    public function form(): Response
    {
        return new Response("login form");
    }

    public function submit(FormRequest $formRequest): Response
    {
        if (!$formRequest->isValid()) {
            return new Response("login failed");
        }

        return new Response("login successful");
    }
}
