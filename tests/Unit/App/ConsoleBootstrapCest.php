<?php

namespace Tests\Unit\App;

use Centum\App\ConsoleBootstrap;
use Centum\Console\Application;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

class ConsoleBootstrapCest
{
    public function test(UnitTester $I): void
    {
        $container = new Container();

        $terminal = $I->createTerminal(
            [
                "cli.php",
                "list",
            ]
        );

        $exitCode = 123;

        $application = Mockery::mock(
            Application::class,
            function (MockInterface $mock) use ($terminal, $exitCode): void {
                $mock->shouldReceive("handle")
                    ->with($terminal)
                    ->andReturn($exitCode)
                    ->once();
            }
        );

        $container->set(Application::class, $application);

        $container->set(Terminal::class, $terminal);



        $bootstrap = Mockery::mock(
            ConsoleBootstrap::class,
            function (MockInterface $mock) use ($exitCode): void {
                $mock->shouldAllowMockingProtectedMethods();
                $mock->makePartial();

                $mock->shouldReceive("exit")
                    ->with($exitCode)
                    ->once();
            }
        );

        $bootstrap->boot($container);
    }
}
