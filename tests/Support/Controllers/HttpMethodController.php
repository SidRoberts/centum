<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class HttpMethodController implements ControllerInterface
{
    public function get(): ResponseInterface
    {
        return new Response("GET");
    }

    public function post(): ResponseInterface
    {
        return new Response("POST");
    }

    public function head(): ResponseInterface
    {
        return new Response("HEAD");
    }

    public function put(): ResponseInterface
    {
        return new Response("PUT");
    }

    public function delete(): ResponseInterface
    {
        return new Response("DELETE");
    }

    public function trace(): ResponseInterface
    {
        return new Response("TRACE");
    }

    public function options(): ResponseInterface
    {
        return new Response("OPTIONS");
    }

    public function connect(): ResponseInterface
    {
        return new Response("CONNECT");
    }

    public function patch(): ResponseInterface
    {
        return new Response("PATCH");
    }
}
