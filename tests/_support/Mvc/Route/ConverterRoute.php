<?php

namespace Centum\Tests\Mvc\Route;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;
use Centum\Tests\Mvc\Converter\Doubler;

class ConverterRoute extends Route
{
    public function getUri() : string
    {
        return "/converter/double/{i:int}";
    }

    public function getConverters() : array
    {
        return [
            "i" => new Doubler(),
        ];
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        return new Response(
            $params["i"]
        );
    }
}
