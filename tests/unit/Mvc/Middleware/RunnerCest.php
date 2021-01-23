<?php

namespace Centum\Tests\Mvc\Middleware;

use Codeception\Example;
use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Middleware\Runner;
use Centum\Mvc\Router\Route;
use Centum\Mvc\Router\Route\Uri;
use Centum\Tests\Mvc\Controller\IndexController;
use Centum\Tests\UnitTester;

class RunnerCest
{
    public function getters(UnitTester $I)
    {
        $runner = new Runner();

        $middleware = new \Centum\Tests\Mvc\Middleware\ExampleTrue();



        $I->assertEquals(
            [],
            $runner->getMiddlewares()
        );



        $runner->addMiddleware($middleware);



        $I->assertEquals(
            [
                $middleware,
            ],
            $runner->getMiddlewares()
        );
    }



    /**
     * @dataProvider runProvider
     */
    public function run(UnitTester $I, Example $example)
    {
        $runner = new Runner();

        foreach ($example["middlewares"] as $middleware) {
            $runner->addMiddleware($middleware);
        }



        $uri = "/";

        $route = new Route(
            new Uri($uri),
            new Path(
                IndexController::class,
                "index"
            )
        );



        $actual = $runner->run($uri, $route);

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }



    public function runProvider() : array
    {
        return [
            [
                "expected"    => true,
                "middlewares" => [
                    new \Centum\Tests\Mvc\Middleware\ExampleTrue(),
                ],
            ],

            [
                "expected"    => false,
                "middlewares" => [
                    new \Centum\Tests\Mvc\Middleware\ExampleFalse(),
                ],
            ],

            [
                "expected"    => false,
                "middlewares" => [
                    new \Centum\Tests\Mvc\Middleware\ExampleTrue(),
                    new \Centum\Tests\Mvc\Middleware\ExampleFalse(),
                ],
            ],

            [
                "expected"    => false,
                "middlewares" => [
                    new \Centum\Tests\Mvc\Middleware\ExampleFalse(),
                    new \Centum\Tests\Mvc\Middleware\ExampleTrue(),
                ],
            ],
        ];
    }
}
