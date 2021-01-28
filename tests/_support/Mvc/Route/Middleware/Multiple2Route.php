<?php

namespace Centum\Tests\Mvc\Route\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;
use Centum\Tests\Mvc\Middleware\ExampleTrue;
use Centum\Tests\Mvc\Middleware\ExampleFalse;

class Multiple2Route extends Route
{
    public function getUri() : string
    {
        return "/middleware/false-true";
    }

    public function getMiddlewares() : array
    {
        return [
            new ExampleFalse(),
            new ExampleTrue(),
        ];
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        return new Response();
    }
}
