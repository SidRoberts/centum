<?php

namespace Tests\Unit\Console;

use Centum\Console\Terminal;
use Tests\Support\UnitTester;

class TerminalCest
{
    /** @var resource */
    protected $stdin;

    /** @var resource */
    protected $stdout;

    /** @var resource */
    protected $stderr;

    protected Terminal $terminal;



    public function _before(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $this->stdin  = fopen("php://memory", "r");
        $this->stdout = fopen("php://memory", "w");
        $this->stderr = fopen("php://memory", "w");

        $this->terminal = new Terminal($argv, $this->stdin, $this->stdout, $this->stderr);
    }



    public function testMultipleWritesToStdOut(UnitTester $I): void
    {
        $this->terminal->write("hello world");

        $this->terminal->write(PHP_EOL);

        $this->terminal->write("goodbye");

        rewind($this->stdout);

        $I->assertEquals(
            "hello world" . PHP_EOL . "goodbye",
            stream_get_contents($this->stdout)
        );
    }

    public function testWriteList(UnitTester $I): void
    {
        $this->terminal->writeList(
            [
                "one",
                "two",
                "three",
            ]
        );

        rewind($this->stdout);

        $I->assertEquals(
            PHP_EOL . " * one" . PHP_EOL . " * two" . PHP_EOL . " * three" . PHP_EOL . PHP_EOL,
            stream_get_contents($this->stdout)
        );
    }

    public function testWriteError(UnitTester $I): void
    {
        $this->terminal->writeError(
            "a problem occurred."
        );

        rewind($this->stdout);

        $I->assertEmpty(
            stream_get_contents($this->stdout)
        );

        rewind($this->stderr);

        $I->assertEquals(
            "a problem occurred.",
            stream_get_contents($this->stderr)
        );
    }

    public function testWriteErrorLine(UnitTester $I): void
    {
        $this->terminal->writeErrorLine(
            "a problem occurred."
        );

        rewind($this->stdout);

        $I->assertEmpty(
            stream_get_contents($this->stdout)
        );

        rewind($this->stderr);

        $I->assertEquals(
            "a problem occurred." . PHP_EOL,
            stream_get_contents($this->stderr)
        );
    }
}
