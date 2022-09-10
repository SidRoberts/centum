<?php

namespace Tests\Unit\App;

use Centum\App\WebBootstrap;
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Router\Router;
use Mockery;
use Mockery\MockInterface;
use Tests\UnitTester;

class WebBootstrapCest
{
    public function test(UnitTester $I): void
    {
        $container = new Container();



        $request = Mockery::mock(Request::class);

        $container->set(Request::class, $request);



        $response = Mockery::mock(
            Response::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("send");
            }
        );



        $router = Mockery::mock(
            Router::class,
            function (MockInterface $mock) use ($request, $response): void {
                $mock->shouldReceive("handle")
                    ->with($request)
                    ->andReturn($response);
            }
        );

        $container->set(Router::class, $router);



        $bootstrap = new WebBootstrap();

        $bootstrap->boot($container);
    }
}
