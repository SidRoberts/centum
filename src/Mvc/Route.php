<?php

namespace Centum\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Exception\RouteNotFoundException;

abstract class Route
{
    abstract public function uri() : string;

    public function middlewares() : array
    {
        return [];
    }

    public function converters() : array
    {
        return [];
    }



    public function get(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }

    public function post(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }

    public function head(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }

    public function put(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }

    public function delete(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }

    public function trace(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }

    public function options(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }

    public function connect(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }

    public function patch(Request $request, Container $container, array $params) : Response
    {
        throw new RouteNotFoundException();
    }
}
