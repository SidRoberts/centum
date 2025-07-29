<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Http\Response\RedirectResponse;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

final class RedirectController implements ControllerInterface
{
    public function redirect1(): ResponseInterface
    {
        return new RedirectResponse("/redirect/2");
    }

    public function redirect2(): ResponseInterface
    {
        return new RedirectResponse("/redirect/3");
    }

    public function redirect3(): ResponseInterface
    {
        return new RedirectResponse("/redirect/finish");
    }

    public function finish(): ResponseInterface
    {
        return new Response("finished redirecting");
    }
}
