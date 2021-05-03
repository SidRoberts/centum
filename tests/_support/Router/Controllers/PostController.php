<?php

namespace Tests\Router\Controllers;

use Centum\Http\Response;

class PostController
{
    public function index(): Response
    {
        return new Response("index");
    }

    public function create(): Response
    {
        return new Response("create");
    }

    public function store(): Response
    {
        return new Response("store");
    }

    public function show(): Response
    {
        return new Response("show");
    }

    public function edit(): Response
    {
        return new Response("edit");
    }

    public function update(): Response
    {
        return new Response("update");
    }

    public function destroy(): Response
    {
        return new Response("destroy");
    }
}
