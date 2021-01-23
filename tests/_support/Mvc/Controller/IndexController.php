<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Router\Route\Uri;

class IndexController extends Controller
{
    #[Uri("/")]
    public function index()
    {
        return "homepage";
    }
}
