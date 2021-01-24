<?php

namespace Centum\Tests\Mvc;

use Centum\Container\Resolver;
use Centum\Mvc\Dispatcher;
use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Application;
use Centum\Mvc\Router;
use Centum\Mvc\Router\Exception\RouteNotFoundException;
use Centum\Mvc\Router\RouteCollection;
use Centum\Container\Container;
use Centum\Tests\Mvc\Controller\ErrorController;
use Centum\Tests\Mvc\Controller\IndexController;
use Centum\Tests\UnitTester;
use Symfony\Component\HttpFoundation\Request;

class ApplicationCest
{
    public function basicHandle(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $routeCollection->addController(
            IndexController::class
        );



        $router = new Router($resolver, $routeCollection);
        $dispatcher = new Dispatcher($resolver);

        $application = new Application($router, $dispatcher);



        $request = Request::create(
            "/",
            "GET"
        );



        $response = $application->handle($request);

        $I->assertEquals(
            "homepage",
            $response->getContent()
        );
    }

    public function getAndSetNotFoundPath(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $routeCollection->addController(
            ErrorController::class
        );



        $router = new Router($resolver, $routeCollection);
        $dispatcher = new Dispatcher($resolver);

        $application = new Application($router, $dispatcher);



        $notFoundPath = new Path(
            ErrorController::class,
            "notFound"
        );



        $I->assertNull(
            $application->getNotFoundPath()
        );

        $application->setNotFoundPath(
            $notFoundPath
        );

        $I->assertEquals(
            $notFoundPath,
            $application->getNotFoundPath()
        );
    }

    public function notFoundPath(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $router = new Router($resolver, $routeCollection);
        $dispatcher = new Dispatcher($resolver);

        $application = new Application($router, $dispatcher);



        $notFoundPath = new Path(
            ErrorController::class,
            "notFound"
        );

        $application->setNotFoundPath(
            $notFoundPath
        );



        $request = Request::create(
            "/this/route/does/not/exist",
            "GET"
        );

        $response = $application->handle($request);



        $I->assertEquals(
            "not found",
            $response->getContent()
        );
    }

    public function routeNotFoundException(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $router = new Router($resolver, $routeCollection);
        $dispatcher = new Dispatcher($resolver);

        $application = new Application($router, $dispatcher);



        $I->expectThrowable(
            RouteNotFoundException::class,
            function () use ($application) {
                $request = Request::create(
                    "/this/route/does/not/exist",
                    "GET"
                );

                $response = $application->handle($request);
            }
        );
    }
}
