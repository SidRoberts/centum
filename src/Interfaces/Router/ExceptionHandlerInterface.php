<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Throwable;

interface ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, Throwable $throwable): ResponseInterface;
}
