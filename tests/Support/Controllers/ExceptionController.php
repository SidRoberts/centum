<?php

namespace Tests\Support\Controllers;

use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;
use InvalidArgumentException;

class ExceptionController implements ControllerInterface
{
    public function index(): ResponseInterface
    {
        throw new InvalidArgumentException();
    }
}
