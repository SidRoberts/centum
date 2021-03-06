<?php

namespace Centum\Console;

use InvalidArgumentException;

class Terminal
{
    protected array $argv;
    protected $stdin;
    protected $stdout;
    protected $stderr;



    public function __construct(array $argv = null, $stdin = STDIN, $stdout = STDOUT, $stderr = STDERR)
    {
        $this->argv = $argv ?? $_SERVER["argv"];

        if (!is_resource($stdin) || !is_resource($stdout) || !is_resource($stderr)) {
            throw new InvalidArgumentException();
        }

        $this->stdin = $stdin;
        $this->stdout = $stdout;
        $this->stderr = $stderr;
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

        /**
         * @var string $item
         */
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



    public function writeError(string $string) : void
    {
        fwrite($this->stderr, $string);

        fflush($this->stderr);
    }

    public function writeErrorLine(string $string = "") : void
    {
        $this->writeError($string . PHP_EOL);
    }
}
