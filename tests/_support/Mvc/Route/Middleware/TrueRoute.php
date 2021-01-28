<?php

namespace Centum\Tests\Mvc\Route\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;
use Centum\Tests\Mvc\Middleware\ExampleTrue;

class TrueRoute extends Route
{
    public function getUri() : string
    {
        return "/middleware/true";
    }

    public function getMiddlewares() : array
    {
        return [
            new ExampleTrue(),
        ];
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        return new Response();
    }
}
