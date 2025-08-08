<?php

namespace Centum\Interfaces\Console;

use Centum\Interfaces\Console\Terminal\ArgumentsInterface;

interface TerminalInterface
{
    public function getArguments(): ArgumentsInterface;



    /**
     * @return resource
     */
    public function getStdIn();

    /**
     * @return resource
     */
    public function getStdOut();

    /**
     * @return resource
     */
    public function getStdErr();



    public function write(string $string): void;

    public function writeLine(string $string = ""): void;



    public function writeError(string $string): void;

    public function writeErrorLine(string $string = ""): void;
}
