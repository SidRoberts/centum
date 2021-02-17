<?php

namespace Tests\Mvc\Controllers;

use Centum\Http\Response;

class IndexController
{
    public function index() : Response
    {
        return new Response("homepage");
    }
}
