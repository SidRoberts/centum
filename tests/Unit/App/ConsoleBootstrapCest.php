<?php

namespace Tests\Unit\App;

use Centum\App\ConsoleBootstrap;
use Centum\Console\Terminal;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

class ConsoleBootstrapCest
{
    public function test(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "list",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

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
