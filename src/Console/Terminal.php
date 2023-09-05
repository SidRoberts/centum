<?php

namespace Centum\Console;

use Centum\Interfaces\Console\Terminal\ArgumentsInterface;
use Centum\Interfaces\Console\TerminalInterface;

class Terminal implements TerminalInterface
{
    /**
     * @param resource $stdin
     * @param resource $stdout
     * @param resource $stderr
     */
    public function __construct(
        protected readonly ArgumentsInterface $arguments,
        protected $stdin = STDIN,
        protected $stdout = STDOUT,
        protected $stderr = STDERR
    ) {
    }



    public function getArguments(): ArgumentsInterface
    {
        return $this->arguments;
    }



    public function getStdIn()
    {
        return $this->stdin;
    }

    public function getStdOut()
    {
        return $this->stdout;
    }

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
