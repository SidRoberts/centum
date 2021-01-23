<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Parameters;
use Centum\Mvc\Router\Route\Requirements;
use Centum\Mvc\Router\Route\Uri;
use InvalidArgumentException;

class RequirementsController extends Controller
{
    #[
    Uri("/requirements/{id}"),
    Requirements(
        [
            "id" => "\d+",
        ]
    )
    ]
    public function show(Parameters $parameters)
    {
        $i = $parameters->get("i");

        if (!preg_match("/^\d+$/", $i) === false) {
            throw new InvalidArgumentException();
        }
    }
}
