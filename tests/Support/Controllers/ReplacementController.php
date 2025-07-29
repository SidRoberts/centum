<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

final class ReplacementController implements ControllerInterface
{
    public function integer(int $i): ResponseInterface
    {
        return new Response(
            serialize($i)
        );
    }

    public function char(string $i): ResponseInterface
    {
        return new Response(
            serialize($i)
        );
    }

    public function doubler(int $i): ResponseInterface
    {
        return new Response(
            serialize($i)
        );
    }
}
