<?php

namespace Centum\Console;

use InvalidArgumentException;

class Terminal
{
    protected array $argv;
    protected $stdin;
    protected $stdout;



    public function __construct(array $argv, $stdin = STDIN, $stdout = STDOUT)
    {
        $this->argv = $argv;

        if (!is_resource($stdin) || !is_resource($stdout)) {
            throw new InvalidArgumentException();
        }

        $this->stdin = $stdin;
        $this->stdout = $stdout;
    }



    public function getArgv() : array
    {
        return $this->argv;
    }



    public function write(string $string) : void
    {
        fwrite($this->stdout, $string);

        fflush($this->stdout);
    }

    public function writeLine(string $string = "") : void
    {
        $this->write($string . PHP_EOL);
    }

    public function writeList(array $list) : void
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
}
