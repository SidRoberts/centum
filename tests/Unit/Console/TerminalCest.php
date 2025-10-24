<?php

namespace Tests\Unit\Console;

use Centum\Console\Terminal;
use Centum\Console\Terminal\Arguments;
use Centum\Interfaces\Console\TerminalInterface;
use RuntimeException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Console\Terminal
 */
final class TerminalCest
{
    protected function getTerminal(): Terminal
    {
        $arguments = new Arguments(
            [
                "cli.php",
                "this:command:does:not:exist",
            ]
        );

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        if ($stdin === false || $stdout === false || $stderr === false) {
            throw new RuntimeException("Failed to open streams.");
        }

        return new Terminal($arguments, $stdin, $stdout, $stderr);
    }



    public function testInterfaces(UnitTester $I): void
    {
        $terminal = $I->mock(Terminal::class);

        $I->assertInstanceOf(TerminalInterface::class, $terminal);
    }

    public function testGetArguments(UnitTester $I): void
    {
        $arguments = $I->mock(Arguments::class);

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        if ($stdin === false || $stdout === false || $stderr === false) {
            throw new RuntimeException("Failed to open streams.");
        }

        $terminal = new Terminal($arguments, $stdin, $stdout, $stderr);

        $I->assertSame(
            $arguments,
            $terminal->getArguments()
        );
    }

    public function testGetStdIn(UnitTester $I): void
    {
        $arguments = $I->mock(Arguments::class);

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        if ($stdin === false || $stdout === false || $stderr === false) {
            throw new RuntimeException("Failed to open streams.");
        }

        $terminal = new Terminal($arguments, $stdin, $stdout, $stderr);

        $I->assertSame(
            $stdin,
            $terminal->getStdIn()
        );
    }

    public function testGetStdOut(UnitTester $I): void
    {
        $arguments = $I->mock(Arguments::class);

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        if ($stdin === false || $stdout === false || $stderr === false) {
            throw new RuntimeException("Failed to open streams.");
        }

        $terminal = new Terminal($arguments, $stdin, $stdout, $stderr);

        $I->assertSame(
            $stdout,
            $terminal->getStdOut()
        );
    }

    public function testGetStdErr(UnitTester $I): void
    {
        $arguments = $I->mock(Arguments::class);

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        if ($stdin === false || $stdout === false || $stderr === false) {
            throw new RuntimeException("Failed to open streams.");
        }

        $terminal = new Terminal($arguments, $stdin, $stdout, $stderr);

        $I->assertSame(
            $stderr,
            $terminal->getStdErr()
        );
    }



    public function testMultipleWritesToStdOut(UnitTester $I): void
    {
        $terminal = $this->getTerminal();

        $terminal->write("hello world");

        $terminal->write(PHP_EOL);

        $terminal->write("goodbye");

        $stdout = $terminal->getStdOut();

        rewind($stdout);

        $I->assertEquals(
            "hello world" . PHP_EOL . "goodbye",
            stream_get_contents($stdout)
        );
    }

    public function testWriteError(UnitTester $I): void
    {
        $terminal = $this->getTerminal();

        $terminal->writeError(
            "a problem occurred."
        );

        $stdout = $terminal->getStdOut();

        rewind($stdout);

        $I->assertEmpty(
            stream_get_contents($stdout)
        );

        $stderr = $terminal->getStdErr();

        rewind($stderr);

        $I->assertEquals(
            "a problem occurred.",
            stream_get_contents($stderr)
        );
    }

    public function testWriteErrorLine(UnitTester $I): void
    {
        $terminal = $this->getTerminal();

        $terminal->writeErrorLine(
            "a problem occurred."
        );

        $stdout = $terminal->getStdOut();

        rewind($stdout);

        $I->assertEmpty(
            stream_get_contents($stdout)
        );

        $stderr = $terminal->getStdErr();

        rewind($stderr);

        $I->assertEquals(
            "a problem occurred." . PHP_EOL,
            stream_get_contents($stderr)
        );
    }
}
