<?php

namespace Centum\Tests\Mvc\Router\Route;

use InvalidArgumentException;
use Centum\Mvc\Router\Route\Uri;
use Centum\Tests\UnitTester;

class UriCest
{
    public function getters(UnitTester $I)
    {
        $uri = "/{a}/{b}";

        $uriClass = new Uri($uri);



        $I->assertEquals(
            $uri,
            $uriClass->getUri()
        );
    }
}
