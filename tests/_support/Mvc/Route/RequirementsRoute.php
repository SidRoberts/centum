<?php

namespace Centum\Tests\Mvc\Route;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class RequirementsRoute extends Route
{
    public function getUri() : string
    {
        return "/requirements/{id:int}";
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        return new Response();
    }
}
