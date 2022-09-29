<?php

namespace Centum\Interfaces\Console;

interface TerminalInterface
{
    /**
     * @return list<string>
     */
    public function getArgv(): array;

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

    /**
     * @param list<string> $list
     */
    public function writeList(array $list): void;



    public function writeError(string $string): void;

    public function writeErrorLine(string $string = ""): void;
}
