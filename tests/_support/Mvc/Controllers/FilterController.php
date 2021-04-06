<?php

namespace Tests\Mvc\Controllers;

use Centum\Http\Response;
use Centum\Mvc\Parameters;

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