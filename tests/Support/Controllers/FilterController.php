<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Router\ParametersInterface;

class FilterController
{
    public function get(ParametersInterface $parameters): Response
    {
        /** @var mixed */
        $i = $parameters->get("i");

        return new Response(
            (string) $i
        );
    }
}
