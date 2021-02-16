<?php

namespace Centum\Tests\Mvc\Route;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;
use Centum\Mvc\Parameters;

class MathRoute extends Route
{
    public function uri() : string
    {
        return "/math/add/{a:int}/{b:int}";
    }

    public function get(Request $request, Container $container, Parameters $parameters) : Response
    {
        $a = $parameters->get("a");
        $b = $parameters->get("b");

        return new Response($a + $b);
    }
}
