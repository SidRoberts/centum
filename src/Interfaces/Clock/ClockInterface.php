<?php

namespace Centum\Interfaces\Clock;

use DateTimeImmutable;

interface ClockInterface
{
    public function now(): DateTimeImmutable;
}
