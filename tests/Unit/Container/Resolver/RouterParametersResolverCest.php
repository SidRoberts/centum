<?php

namespace Tests\Unit\Container\Resolver;

use Centum\Http\Request;
use Centum\Interfaces\Http\SessionInterface;
use Centum\Router\Router;
use Tests\Support\Controllers\ParametersController;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Resolver\RouterParametersResolver
 */
class RouterParametersResolverCest
{
    public function testRegularParameter(UnitTester $I): void
    {
        $container = $I->grabContainer();

        $router = new Router($container);

        $group = $router->group();

        $group->get("/{username}", ParametersController::class, "regularParameter");

        $request = new Request("/sidroberts");

        $response = $router->handle($request);

        $I->assertEquals(
            "Hello sidroberts!",
            $response->getContent()
        );
    }

    public function testFromContainer(UnitTester $I): void
    {
        $container = $I->grabContainer();

        $router = new Router($container);

        $group = $router->group();

        $group->get("/", ParametersController::class, "sessionFromContainer");

        $request = new Request("/");

        $response = $router->handle($request);

        $session = $container->get(SessionInterface::class);

        $I->assertEquals(
            $session::class,
            $response->getContent()
        );
    }
}
