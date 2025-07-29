<?php

namespace Tests\Unit\App;

use Centum\App\ConsoleBootstrap;
use Centum\Console\Terminal;
use Centum\Console\Terminal\Arguments;
use Centum\Interfaces\Console\ApplicationInterface;
use Mockery;
use Mockery\MockInterface;
use RuntimeException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\App\ConsoleBootstrap
 */
final class ConsoleBootstrapCest
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

        if ($stdin === false || $stdout === false || $stderr === false) {
            throw new RuntimeException("Failed to open streams.");
        }

        $terminal = new Terminal($arguments, $stdin, $stdout, $stderr);

        $exitCode = 123;

        $application = $I->mockInContainer(
            ApplicationInterface::class,
            function (MockInterface $mock) use ($terminal, $exitCode): void {
                $mock->shouldReceive("handle")
                    ->with($terminal)
                    ->andReturn($exitCode)
                    ->once();
            }
        );



        /** @var ConsoleBootstrap */
        $bootstrapMock = Mockery::mock(
            ConsoleBootstrap::class,
            [$application],
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

        $bootstrapMock->boot();
    }
}
