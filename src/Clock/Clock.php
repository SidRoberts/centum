<?php

namespace Centum\Clock;

use Centum\Interfaces\Clock\ClockInterface;
use DateTimeImmutable;
use DateTimeZone;

class Clock implements ClockInterface
{
    protected string $datetime;
    protected DateTimeZone|null $timezone;



    public function __construct(string $datetime = "now", DateTimeZone|null $timezone = null)
    {
        $this->datetime = $datetime;
        $this->timezone = $timezone;
    }



    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->datetime, $this->timezone);
    }
}
