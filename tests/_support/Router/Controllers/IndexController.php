<?php

namespace Tests\Router\Controllers;

use Centum\Http\Response;

class IndexController
{
    public function index(): Response
    {
        return new Response("homepage");
    }
}
