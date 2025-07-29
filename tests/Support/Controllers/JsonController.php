<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response\JsonResponse;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

final class JsonController implements ControllerInterface
{
    public function index(): ResponseInterface
    {
        return new JsonResponse(
            [
                "a" => 1,
                "b" => 2,
                "c" => [3, 4],
            ]
        );
    }
}
