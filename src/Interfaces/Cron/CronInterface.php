<?php

namespace Centum\Interfaces\Cron;

use DateTimeInterface;

interface CronInterface
{
    public function add(JobInterface $job): void;

    public function getDueJobs(DateTimeInterface $datetime = null): array;

    public function getAllJobs(): array;
}
