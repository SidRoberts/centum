<?php

namespace Centum\Interfaces\Console;

use Centum\Interfaces\Console\Terminal\ArgumentsInterface;

interface CommandBuilderInterface
{
    /**
     * @param class-string $class
     */
    public function build(string $class, ArgumentsInterface $arguments): CommandInterface;
}
