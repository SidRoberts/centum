<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class IndexController implements ControllerInterface
{
    public function index(): ResponseInterface
    {
        return new Response("homepage");
    }
}
