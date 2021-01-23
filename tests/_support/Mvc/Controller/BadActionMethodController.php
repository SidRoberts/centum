<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;

class BadActionMethodController extends Controller
{
    /*
     * This action doesn't have a Uri attribute.
     */
    public function index()
    {
        return "homepage";
    }
}
