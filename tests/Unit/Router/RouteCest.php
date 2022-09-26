<?php

namespace Tests\Unit\Router;

use Centum\Router\Route;
use Tests\Support\Controllers\IndexController;
use Tests\Support\UnitTester;

class RouteCest
{
    protected Route $route;



    public function _before(UnitTester $I): void
    {
        $this->route = new Route(
            "GET",
            "/",
            IndexController::class,
            "index"
        );
    }



    public function testGetHttpMethod(UnitTester $I): void
    {
        $I->assertEquals(
            "GET",
            $this->route->getHttpMethod()
        );
    }

    public function testGetUri(UnitTester $I): void
    {
        $I->assertEquals(
            "/",
            $this->route->getUri()
        );
    }

    public function testGetClass(UnitTester $I): void
    {
        $I->assertEquals(
            IndexController::class,
            $this->route->getClass()
        );
    }

    public function testGetMethod(UnitTester $I): void
    {
        $I->assertEquals(
            "index",
            $this->route->getMethod()
        );
    }
}
