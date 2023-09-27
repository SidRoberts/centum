<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Http\SessionInterface;
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

    public function requestFromContainer(RequestInterface $request): ResponseInterface
    {
        return new Response(
            $request::class
        );
    }

    public function sessionFromContainer(SessionInterface $session): ResponseInterface
    {
        return new Response(
            $session::class
        );
    }
}
