<?php

namespace Tests\Support\Controllers;

use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Router\Parameters;

class RequirementsController
{
    public function required(Request $request, ContainerInterface $container, Parameters $parameters): Response
    {
        return new Response();
    }
}
