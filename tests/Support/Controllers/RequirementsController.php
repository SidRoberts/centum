<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;

class RequirementsController
{
    public function required(): ResponseInterface
    {
        return new Response();
    }
}
