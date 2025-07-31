<?php

namespace Centum\Clock;

use DateTimeImmutable;
use DateTimeZone;

class SystemClock extends Clock
{
    public function __construct(
        protected ?DateTimeZone $timeZone = null
    ) {
    }



    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable("now", $this->timeZone);
    }

    public function sleep(int $seconds): void
    {
        sleep($seconds);
    }
}
