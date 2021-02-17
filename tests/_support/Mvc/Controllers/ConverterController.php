<?php

namespace Tests\Mvc\Controllers;

use Centum\Http\Response;
use Centum\Mvc\Parameters;

class ConverterController
{
    public function get(Parameters $parameters) : Response
    {
        return new Response(
            $parameters->get("i")
        );
    }
}
