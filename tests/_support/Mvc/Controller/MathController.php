<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Parameters;
use Centum\Mvc\Router\Route\Requirement;
use Centum\Mvc\Router\Route\Uri;

class MathController extends Controller
{
    #[Uri("/math/add/{a}/{b}")]
    #[Requirement("a", "\d+")]
    #[Requirement("b", "\d+")]
    public function addition(Parameters $parameters)
    {
        $a = $parameters->get("a");
        $b = $parameters->get("b");

        return $a + $b;
    }
}
