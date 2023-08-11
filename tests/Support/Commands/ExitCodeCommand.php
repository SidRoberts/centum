<?php

namespace Tests\Support\Commands;

use Centum\Console\CommandMetadata;
use Centum\Filter\Cast\ToInteger;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("exit-code")]
class ExitCodeCommand implements CommandInterface
{
    protected readonly int $exitCode;



    public function __construct(
        string $exitCode,
        ToInteger $toIntegerFilter
    ) {
        $this->exitCode = $toIntegerFilter->filter($exitCode);
    }



    public function execute(TerminalInterface $terminal): int
    {
        return $this->exitCode;
    }
}
