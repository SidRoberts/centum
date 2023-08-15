<?php

namespace Centum\Interfaces\Console;

use Throwable;

interface ExceptionHandlerInterface
{
    public function handle(TerminalInterface $terminal, Throwable $throwable): void;
}
