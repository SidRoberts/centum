<?php

namespace Tests\Router\Controllers;

use Centum\Http\Response;
use Centum\Router\Parameters;

class FilterController
{
    public function get(Parameters $parameters): Response
    {
        /**
         * @var mixed
         */
        $i = $parameters->get("i");

        return new Response(
            (string) $i
        );
    }
}
