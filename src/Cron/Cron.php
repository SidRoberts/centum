<?php

namespace Centum\Cron;

use DateTimeInterface;

class Cron
{
    /** @var JobInterface[] $jobs */
    protected array $jobs = [];



    public function add(JobInterface $job): void
    {
        $this->jobs[] = $job;
    }

    public function getDueJobs(DateTimeInterface $datetime = null): array
    {
        $jobs = array_filter(
            $this->jobs,
            function (JobInterface $job) use ($datetime): bool {
                return $job->isDue($datetime);
            }
        );

        return $jobs;
    }

    public function getAllJobs(): array
    {
        return $this->jobs;
    }
}
