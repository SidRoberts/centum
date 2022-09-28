<?php

namespace Tests\Unit\App;

use Centum\App\ConsoleBootstrap;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

class ConsoleBootstrapCest
{
    public function test(UnitTester $I): void
    {
        $container = $I->getContainer();



        $terminal = $I->createTerminal(
            [
                "cli.php",
                "list",
            ]
        );

        $exitCode = 123;

        $application = Mockery::mock(
            ApplicationInterface::class,
            function (MockInterface $mock) use ($terminal, $exitCode): void {
                $mock->shouldReceive("handle")
                    ->with($terminal)
                    ->andReturn($exitCode)
                    ->once();
            }
        );

        $container->set(ApplicationInterface::class, $application);

        $container->set(TerminalInterface::class, $terminal);



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
