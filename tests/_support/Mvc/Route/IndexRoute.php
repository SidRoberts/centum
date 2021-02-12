<?php

namespace Centum\Tests\Mvc\Route;

use Centum\Container\Container;
use Centum\Mvc\Route;
use Centum\Http\Request;
use Centum\Http\Response;

class IndexRoute extends Route
{
    public function uri() : string
    {
        return "/";
    }

    public function get(Request $request, Container $container, array $params) : Response
    {
        return new Response("homepage");
    }
}
