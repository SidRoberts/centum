<?php

namespace Tests\Support;

class ExitCode
{
    public function __construct(
        protected readonly int $exitCode
    ) {
    }



    public function getExitCode(): int
    {
        return $this->exitCode;
    }
}
