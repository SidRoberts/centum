<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Router\Route\Uri;

class HttpMethodController extends Controller
{
    #[Uri("/", "GET")]
    public function get()
    {
    }

    #[Uri("/", "POST")]
    public function post()
    {
    }
}
