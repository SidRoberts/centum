<?php

namespace Centum\Tests\Mvc\Route;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class MathRoute extends Route
{
    public function uri() : string
    {
        return "/math/add/{a:int}/{b:int}";
    }

    public function get(Request $request, Container $container, array $params) : Response
    {
        $a = $params["a"];
        $b = $params["b"];

        return new Response($a + $b);
    }
}
