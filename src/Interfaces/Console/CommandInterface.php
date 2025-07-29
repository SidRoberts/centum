<?php

namespace Centum\Interfaces\Console;

interface CommandInterface
{
    // Command completed successfully.
    public const int SUCCESS = 0;

    // An error happened during the execution.
    public const int FAILURE = 1;

    // Incorrect command usage (e.g. invalid options or missing arguments).
    public const int INVALID = 2;



    public function execute(TerminalInterface $terminal): int;
}
