<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class ParametersController implements ControllerInterface
{
    public function regularParameter(string $username): ResponseInterface
    {
        return new Response(
            sprintf(
                "Hello %s!",
                $username
            )
        );
    }

    public function fromContainer(RequestInterface $request): ResponseInterface
    {
        return new Response(
            get_class($request)
        );
    }
}
