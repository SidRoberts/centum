<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;

class IndexController
{
    public function index(): ResponseInterface
    {
        return new Response("homepage");
    }
}
