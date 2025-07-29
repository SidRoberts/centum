<?php

namespace Tests\Support\Commands;

use Centum\Console\CommandMetadata;
use Centum\Filter\Cast\ToInteger;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("math:add")]
final class MathCommand implements CommandInterface
{
    protected readonly int $a;
    protected readonly int $b;



    public function __construct(
        ToInteger $toIntegerFilter,
        string $a,
        string $b,
    ) {
        $this->a = $toIntegerFilter->filter($a);
        $this->b = $toIntegerFilter->filter($b);
    }



    public function execute(TerminalInterface $terminal): int
    {
        $terminal->write(
            sprintf(
                "%d+%d=%d",
                $this->a,
                $this->b,
                $this->a + $this->b
            )
        );

        return self::SUCCESS;
    }
}
