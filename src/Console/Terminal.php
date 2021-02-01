<?php

namespace Centum\Console;

class Terminal
{
    protected array $argv;



    public function __construct(array $argv)
    {
        $this->argv = $argv;
    }



    public function getArgv() : array
    {
        return $this->argv;
    }



    public function write(string $string) : void
    {
        fwrite(STDOUT, $string);

        fflush(STDOUT);
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
