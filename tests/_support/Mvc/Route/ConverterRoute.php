<?php

namespace Centum\Tests\Mvc\Route;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;
use Centum\Tests\Mvc\Converter\Doubler;

class ConverterRoute extends Route
{
    public function uri() : string
    {
        return "/converter/double/{i:int}";
    }

    public function converters() : array
    {
        return [
            "i" => new Doubler(),
        ];
    }

    public function get(Request $request, Container $container, array $params) : Response
    {
        return new Response(
            $params["i"]
        );
    }
}
