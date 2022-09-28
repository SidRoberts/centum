<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ParametersInterface;

class RequirementsController
{
    public function required(RequestInterface $request, ContainerInterface $container, ParametersInterface $parameters): ResponseInterface
    {
        return new Response();
    }
}
