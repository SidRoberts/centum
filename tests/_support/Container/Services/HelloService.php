<?php

namespace Centum\Tests\Container\Services;

use Centum\Container\Service;

class HelloService extends Service
{
    public function getName() : string
    {
        return "hello";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        return "hello";
    }
}
