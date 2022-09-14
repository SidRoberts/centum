<?php

namespace Centum\Cron;

use DateTimeInterface;

interface JobInterface
{
    public function isDue(DateTimeInterface $datetime = null): bool;
}
