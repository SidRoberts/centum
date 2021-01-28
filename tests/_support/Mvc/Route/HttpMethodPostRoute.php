<?php

namespace Centum\Tests\Mvc\Route;

use Centum\Container\Container;
use Centum\Mvc\Route;
use Centum\Http\Request;
use Centum\Http\Response;

class HttpMethodPostRoute extends Route
{
    public function getUri() : string
    {
        return "/";
    }

    public function getMethod() : string
    {
        return "POST";
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        return new Response(
            $this->getMethod()
        );
    }
}
