<?php

namespace Centum\Console;

use InvalidArgumentException;

class Terminal
{
    protected array $argv;

    /**
     * @var resource
     */
    protected $stdin;

    /**
     * @var resource
     */
    protected $stdout;

    /**
     * @var resource
     */
    protected $stderr;



    /**
     * @param resource $stdin
     * @param resource $stdout
     * @param resource $stderr
     */
    public function __construct(array $argv = null, $stdin = STDIN, $stdout = STDOUT, $stderr = STDERR)
    {
        /**
         * @var array
         */
        $this->argv = $argv ?? $_SERVER["argv"];

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

    /**
     * @param string[] $list
     */
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
