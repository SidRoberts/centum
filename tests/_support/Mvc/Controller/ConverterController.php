<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Parameters;
use Centum\Mvc\Router\Route\Converters;
use Centum\Mvc\Router\Route\Uri;
use Centum\Tests\Mvc\Converter\Doubler;

class ConverterController extends Controller
{
    #[
    Uri("/converter/double/{i}"),
    Converters(
        [
            "i" => Doubler::class
        ]
    )
    ]
    public function double(Parameters $parameters)
    {
        $i = $parameters->get("i");
    }
}
