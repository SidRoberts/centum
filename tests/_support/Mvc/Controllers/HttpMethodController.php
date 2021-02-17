<?php

namespace Tests\Mvc\Controllers;

use Centum\Http\Response;

class HttpMethodController
{
    public function get() : Response
    {
        return new Response("GET");
    }

    public function post() : Response
    {
        return new Response("POST");
    }
}
