<?php

namespace Centum\Clock;

use Centum\Interfaces\Clock\ClockInterface;
use DateTimeImmutable;
use DateTimeZone;

class Clock implements ClockInterface
{
    public function __construct(
        protected string $datetime = "now",
        protected DateTimeZone|null $timezone = null
    ) {
    }



    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->datetime, $this->timezone);
    }
}
