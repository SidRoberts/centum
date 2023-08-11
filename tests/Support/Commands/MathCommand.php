<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Filter\Cast\ToInteger;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("math:add")]
class MathCommand extends Command
{
    public function __construct(
        protected readonly ToInteger $toIntegerFilter
    ) {
    }



    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        $a = $this->toIntegerFilter->filter($parameters->get("a"));
        $b = $this->toIntegerFilter->filter($parameters->get("b"));

        $terminal->write(
            sprintf(
                "%d+%d=%d",
                $a,
                $b,
                $a + $b
            )
        );

        return self::SUCCESS;
    }
}
