<?php

namespace Tests\Unit\Console;

use Centum\Console\Terminal;
use Tests\Support\UnitTester;

class TerminalCest
{
    public function testMultipleWritesToStdOut(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $terminal->write("hello world");

        $terminal->write(PHP_EOL);

        $terminal->write("goodbye");

        rewind($stdout);

        $I->assertEquals(
            "hello world" . PHP_EOL . "goodbye",
            stream_get_contents($stdout)
        );
    }

    public function testWriteList(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $terminal->writeList(
            [
                "one",
                "two",
                "three",
            ]
        );

        rewind($stdout);

        $I->assertEquals(
            PHP_EOL . " * one" . PHP_EOL . " * two" . PHP_EOL . " * three" . PHP_EOL . PHP_EOL,
            stream_get_contents($stdout)
        );
    }

    public function testWriteError(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $terminal->writeError(
            "a problem occurred."
        );

        rewind($stdout);

        $I->assertEmpty(
            stream_get_contents($stdout)
        );

        rewind($stderr);

        $I->assertEquals(
            "a problem occurred.",
            stream_get_contents($stderr)
        );
    }


    public function testWriteErrorLine(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin  = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $terminal->writeErrorLine(
            "a problem occurred."
        );

        rewind($stdout);

        $I->assertEmpty(
            stream_get_contents($stdout)
        );

        rewind($stderr);

        $I->assertEquals(
            "a problem occurred." . PHP_EOL,
            stream_get_contents($stderr)
        );
    }
}
