<?php

namespace Tests\Mvc\Controllers;

use Centum\Http\Response;

class HttpMethodController
{
    public function get(): Response
    {
        return new Response("GET");
    }

    public function post(): Response
    {
        return new Response("POST");
    }

    public function head(): Response
    {
        return new Response("HEAD");
    }

    public function put(): Response
    {
        return new Response("PUT");
    }

    public function delete(): Response
    {
        return new Response("DELETE");
    }

    public function trace(): Response
    {
        return new Response("TRACE");
    }

    public function options(): Response
    {
        return new Response("OPTIONS");
    }

    public function connect(): Response
    {
        return new Response("CONNECT");
    }

    public function patch(): Response
    {
        return new Response("PATCH");
    }
}
