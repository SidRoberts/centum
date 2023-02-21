<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ParametersInterface;

class ReplacementController
{
    public function get(ParametersInterface $parameters): ResponseInterface
    {
        /** @var mixed */
        $i = $parameters->get("i");

        return new Response(
            serialize($i)
        );
    }
}
