<?php

namespace Tests\Unit\Router;

use Centum\Router\Route;
use Tests\Support\Controllers\IndexController;
use Tests\Support\UnitTester;

class RouteCest
{
    protected function getRoute(): Route
    {
        return new Route(
            "GET",
            "/",
            IndexController::class,
            "index"
        );
    }



    public function testGetHttpMethod(UnitTester $I): void
    {
        $route = $this->getRoute();

        $I->assertEquals(
            "GET",
            $route->getHttpMethod()
        );
    }

    public function testGetUri(UnitTester $I): void
    {
        $route = $this->getRoute();

        $I->assertEquals(
            "/",
            $route->getUri()
        );
    }

    public function testGetClass(UnitTester $I): void
    {
        $route = $this->getRoute();

        $I->assertEquals(
            IndexController::class,
            $route->getClass()
        );
    }

    public function testGetMethod(UnitTester $I): void
    {
        $route = $this->getRoute();

        $I->assertEquals(
            "index",
            $route->getMethod()
        );
    }
}
