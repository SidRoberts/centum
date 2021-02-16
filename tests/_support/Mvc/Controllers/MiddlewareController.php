<?php

namespace Centum\Tests\Mvc\Controllers;

use Centum\Http\Response;

class MiddlewareController
{
    public function index() : Response
    {
        return new Response();
    }
}
