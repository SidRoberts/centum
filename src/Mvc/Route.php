<?php

namespace Centum\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;

abstract class Route
{
    abstract public function getUri() : string;

    public function getMethod() : string
    {
        return "GET";
    }

    public function getMiddlewares() : array
    {
        return [];
    }

    public function getConverters() : array
    {
        return [];
    }

    abstract public function execute(Request $request, Container $container, array $params) : Response;
}
