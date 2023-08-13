<?php

namespace Tests\Unit\App;

use Centum\App\ConsoleBootstrap;
use Centum\Console\Terminal;
use Centum\Console\Terminal\Arguments;
use Centum\Interfaces\Console\ApplicationInterface;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

class ConsoleBootstrapCest
{
    public function test(UnitTester $I): void
    {
        $arguments = new Arguments(
            [
                "cli.php",
                "list",
            ]
        );

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($arguments, $stdin, $stdout, $stderr);

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



        $bootstrap = $I->mock(
            ConsoleBootstrap::class,
            function (MockInterface $mock) use ($terminal, $exitCode): void {
                $mock->shouldAllowMockingProtectedMethods();
                $mock->makePartial();

                $mock->shouldReceive("getTerminal")
                    ->andReturn($terminal)
                    ->once();

                $mock->shouldReceive("exit")
                    ->with($exitCode)
                    ->once();
            }
        );

        $container = $I->grabContainer();

        $bootstrap->boot($container);
    }
}
