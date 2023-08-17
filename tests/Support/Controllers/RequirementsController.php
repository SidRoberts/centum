<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class RequirementsController implements ControllerInterface
{
    public function required(): ResponseInterface
    {
        return new Response("");
    }
}
