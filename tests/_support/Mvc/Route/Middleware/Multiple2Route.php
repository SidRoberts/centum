<?php

namespace Centum\Tests\Mvc\Route\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;
use Centum\Mvc\Parameters;
use Centum\Tests\Mvc\Middleware\ExampleTrue;
use Centum\Tests\Mvc\Middleware\ExampleFalse;

class Multiple2Route extends Route
{
    public function uri() : string
    {
        return "/middleware/false-true";
    }

    public function middlewares() : array
    {
        return [
            new ExampleFalse(),
            new ExampleTrue(),
        ];
    }

    public function get(Request $request, Container $container, Parameters $parameters) : Response
    {
        return new Response();
    }
}
