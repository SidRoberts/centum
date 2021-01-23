<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Parameters;
use Centum\Mvc\Router\Route\Requirements;
use Centum\Mvc\Router\Route\Uri;

class ParametersController extends Controller
{
    #[Uri("/parameters/{name}")]
    public function a(Parameters $parameters)
    {
        $name = $parameters->get("name");
    }

    #[
    Uri("/parameters/{name}/{id}"),
    Requirements(
        [
            "id" => "\d+",
        ]
    )
    ]
    public function b(Parameters $parameters)
    {
        $name = $parameters->get("name");
        $id   = $parameters->get("id");
    }

    #[
    Uri("/parameters/{name}/{id}/{date}"),
    Requirements(
        [
            "id"   => "\d+",
            "date" => "[0-9\-]+",
        ]
    )
    ]
    public function c(Parameters $parameters)
    {
        $name = $parameters->get("name");
        $id   = $parameters->get("id");
        $date = $parameters->get("date");
    }
}
