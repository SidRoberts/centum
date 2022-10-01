<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response\JsonResponse;
use Centum\Interfaces\Http\ResponseInterface;

class JsonController
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
