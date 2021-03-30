<?php

namespace Tests\Mvc\Controllers;

use Centum\Http\Response;
use Centum\Mvc\Parameters;

class ConverterController
{
    public function get(Parameters $parameters): Response
    {
        $i = $parameters->get("i");

        return new Response(
            $i
        );
    }
}
