<?php

namespace Centum\Interfaces\Cron;

use DateTimeInterface;

interface CronInterface
{
    public function add(JobInterface $job): void;

    /**
     * @return array<JobInterface>
     */
    public function getDueJobs(DateTimeInterface $datetime = null): array;

    /**
     * @return array<JobInterface>
     */
    public function getAllJobs(): array;
}
