<?php

namespace Centum\Tests\Mvc\Route;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;
use Centum\Mvc\Parameters;

class RequirementsRoute extends Route
{
    public function uri() : string
    {
        return "/requirements/{id:int}";
    }

    public function get(Request $request, Container $container, Parameters $parameters) : Response
    {
        return new Response();
    }
}
