<?php

namespace Centum\Clock;

use Centum\Interfaces\Clock\ClockInterface;
use DateTimeZone;

abstract class Clock implements ClockInterface
{
    public function __construct(
        protected string $datetime = "now",
        protected ?DateTimeZone $timezone = null
    ) {
    }
}
