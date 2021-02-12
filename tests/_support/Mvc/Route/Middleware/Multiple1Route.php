<?php

namespace Centum\Tests\Mvc\Route\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;
use Centum\Tests\Mvc\Middleware\ExampleTrue;
use Centum\Tests\Mvc\Middleware\ExampleFalse;

class Multiple1Route extends Route
{
    public function uri() : string
    {
        return "/middleware/true-false";
    }

    public function middlewares() : array
    {
        return [
            new ExampleTrue(),
            new ExampleFalse(),
        ];
    }

    public function get(Request $request, Container $container, array $params) : Response
    {
        return new Response();
    }
}
