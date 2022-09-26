<?php

namespace Tests\Support\Controllers;

use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Router\ParametersInterface;

class RequirementsController
{
    public function required(Request $request, ContainerInterface $container, ParametersInterface $parameters): Response
    {
        return new Response();
    }
}
