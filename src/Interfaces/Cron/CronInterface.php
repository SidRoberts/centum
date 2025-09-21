<?php

namespace Centum\Interfaces\Cron;

use DateTimeInterface;

interface CronInterface
{
    public function add(JobInterface $job): void;

    /**
     * @return list<JobInterface>
     */
    public function getDueJobs(?DateTimeInterface $datetime = null): array;

    /**
     * @return list<JobInterface>
     */
    public function getAllJobs(): array;
}
