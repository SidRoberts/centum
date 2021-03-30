<?php

namespace Tests\Mvc\Controllers;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Parameters;

class RequirementsController
{
    public function required(Request $request, Container $container, Parameters $parameters): Response
    {
        return new Response();
    }
}
