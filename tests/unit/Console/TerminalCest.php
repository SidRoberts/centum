<?php

namespace Tests\Unit\Console;

use Centum\Console\Terminal;
use Tests\UnitTester;

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
}
