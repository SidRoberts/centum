<?php

namespace Centum\Console;

use Centum\Console\Exception\ArgvNotFoundException;
use Centum\Interfaces\Console\TerminalInterface;

class Terminal implements TerminalInterface
{
    /** @var array<string> */
    protected readonly array $argv;



    /**
     * @param array<string> $argv
     * @param resource $stdin
     * @param resource $stdout
     * @param resource $stderr
     */
    public function __construct(
        array $argv = null,
        protected $stdin = STDIN,
        protected $stdout = STDOUT,
        protected $stderr = STDERR
    ) {
        $this->argv = $argv ?? $_SERVER["argv"] ?? throw new ArgvNotFoundException();
    }



    /**
     * @return array<string>
     */
    public function getArgv(): array
    {
        return $this->argv;
    }

    /**
     * @return resource
     */
    public function getStdIn()
    {
        return $this->stdin;
    }

    /**
     * @return resource
     */
    public function getStdOut()
    {
        return $this->stdout;
    }

    /**
     * @return resource
     */
    public function getStdErr()
    {
        return $this->stderr;
    }



    public function write(string $string): void
    {
        fwrite($this->stdout, $string);

        fflush($this->stdout);
    }

    public function writeLine(string $string = ""): void
    {
        $this->write($string . PHP_EOL);
    }

    /**
     * @param array<string> $list
     */
    public function writeList(array $list): void
    {
        $this->writeLine();

        foreach ($list as $item) {
            $this->writeLine(
                sprintf(
                    " * %s",
                    $item
                )
            );
        }

        $this->writeLine();
    }



    public function writeError(string $string): void
    {
        fwrite($this->stderr, $string);

        fflush($this->stderr);
    }

    public function writeErrorLine(string $string = ""): void
    {
        $this->writeError($string . PHP_EOL);
    }
}
