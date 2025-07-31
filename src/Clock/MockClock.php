<?php

namespace Centum\Clock;

use DateTime;
use DateTimeImmutable;
use DateTimeZone;

class MockClock extends Clock
{
    protected DateTime $dateTime;

    protected ?DateTime $timeStarted = null;



    public function __construct(
        protected string $datetime = "now",
        protected ?DateTimeZone $timeZone = null
    ) {
        $this->dateTime = new DateTime($datetime, $this->timeZone);
    }



    public function now(): DateTimeImmutable
    {
        $this->updateTime();

        return DateTimeImmutable::createFromMutable($this->dateTime);
    }

    public function sleep(int $seconds): void
    {
        // No actual sleep, as this is a mock clock.

        $this->modify("+{$seconds} seconds");
    }



    public function modify(string $modifier): void
    {
        $this->dateTime->modify($modifier);
    }



    public function start(): void
    {
        $this->timeStarted = new DateTime();
    }

    public function stop(): void
    {
        $this->updateTime();

        $this->timeStarted = null;
    }

    protected function updateTime(): void
    {
        if ($this->timeStarted === null) {
            return;
        }

        $timeStopped = new DateTime();

        $elapsed = $timeStopped->getTimestamp() - $this->timeStarted->getTimestamp();

        $this->modify("+{$elapsed} seconds");
    }
}
