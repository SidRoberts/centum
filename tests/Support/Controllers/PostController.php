<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class PostController implements ControllerInterface
{
    public function index(): ResponseInterface
    {
        return new Response("index");
    }

    public function create(): ResponseInterface
    {
        return new Response("create");
    }

    public function store(): ResponseInterface
    {
        return new Response("store");
    }

    public function show(): ResponseInterface
    {
        return new Response("show");
    }

    public function edit(): ResponseInterface
    {
        return new Response("edit");
    }

    public function update(): ResponseInterface
    {
        return new Response("update");
    }

    public function destroy(): ResponseInterface
    {
        return new Response("destroy");
    }
}
