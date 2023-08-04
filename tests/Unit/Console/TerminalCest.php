<?php

namespace Tests\Unit\Console;

use Centum\Console\Terminal;
use Tests\Support\UnitTester;

class TerminalCest
{
    protected function getTerminal(): Terminal
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        return new Terminal($argv, $stdin, $stdout, $stderr);
    }



    public function testGetArgv(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $I->assertSame(
            $argv,
            $terminal->getArgv()
        );
    }

    public function testGetStdIn(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $I->assertSame(
            $stdin,
            $terminal->getStdIn()
        );
    }

    public function testGetStdOut(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $I->assertSame(
            $stdout,
            $terminal->getStdOut()
        );
    }

    public function testGetStdErr(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

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

    public function testWriteList(UnitTester $I): void
    {
        $terminal = $this->getTerminal();

        $terminal->writeList(
            [
                "one",
                "two",
                "three",
            ]
        );

        $stdout = $terminal->getStdOut();

        rewind($stdout);

        $I->assertEquals(
            PHP_EOL . " * one" . PHP_EOL . " * two" . PHP_EOL . " * three" . PHP_EOL . PHP_EOL,
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
