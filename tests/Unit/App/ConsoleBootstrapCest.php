<?php

namespace Tests\Unit\App;

use Centum\App\ConsoleBootstrap;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

class ConsoleBootstrapCest
{
    public function test(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            [
                "cli.php",
                "list",
            ]
        );

        $exitCode = 123;

        $I->mockInContainer(
            ApplicationInterface::class,
            function (MockInterface $mock) use ($terminal, $exitCode): void {
                $mock->shouldReceive("handle")
                    ->with($terminal)
                    ->andReturn($exitCode)
                    ->once();
            }
        );

        $I->addToContainer(TerminalInterface::class, $terminal);



        $bootstrap = $I->mock(
            ConsoleBootstrap::class,
            function (MockInterface $mock) use ($exitCode): void {
                $mock->shouldAllowMockingProtectedMethods();
                $mock->makePartial();

                $mock->shouldReceive("exit")
                    ->with($exitCode)
                    ->once();
            }
        );

        $container = $I->getContainer();

        $bootstrap->boot($container);
    }
}
