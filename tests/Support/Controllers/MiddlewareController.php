<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;

class MiddlewareController
{
    public function index(): ResponseInterface
    {
        return new Response();
    }
}
