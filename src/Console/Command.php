<?php

namespace Centum\Console;

use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;

abstract class Command implements CommandInterface
{
    abstract public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int;
}
