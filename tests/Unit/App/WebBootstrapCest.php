<?php

namespace Tests\Unit\App;

use Centum\App\WebBootstrap;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\RouterInterface;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\App\WebBootstrap
 */
final class WebBootstrapCest
{
    public function test(UnitTester $I): void
    {
        $request = $I->mockInContainer(RequestInterface::class);

        $response = $I->mock(
            ResponseInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("send");
            }
        );



        $router = $I->mock(
            RouterInterface::class,
            function (MockInterface $mock) use ($request, $response): void {
                $mock->shouldReceive("handle")
                    ->with($request)
                    ->andReturn($response);
            }
        );



        $webBootstrap = new WebBootstrap($router, $request);

        $webBootstrap->boot();
    }
}
