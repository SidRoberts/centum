<?php

namespace Tests\Unit\App;

use Centum\App\WebBootstrap;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\RouterInterface;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

class WebBootstrapCest
{
    public function test(UnitTester $I): void
    {
        $container = $I->getContainer();



        $request = Mockery::mock(RequestInterface::class);

        $container->set(RequestInterface::class, $request);



        $response = Mockery::mock(
            ResponseInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("send");
            }
        );



        $router = Mockery::mock(
            RouterInterface::class,
            function (MockInterface $mock) use ($request, $response): void {
                $mock->shouldReceive("handle")
                    ->with($request)
                    ->andReturn($response);
            }
        );

        $container->set(RouterInterface::class, $router);



        $bootstrap = new WebBootstrap();

        $bootstrap->boot($container);
    }
}
