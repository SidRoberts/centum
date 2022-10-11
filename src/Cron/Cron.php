<?php

namespace Centum\Cron;

use Centum\Interfaces\Cron\CronInterface;
use Centum\Interfaces\Cron\JobInterface;
use DateTimeInterface;

class Cron implements CronInterface
{
    /** @var array<JobInterface> $jobs */
    protected array $jobs = [];



    public function add(JobInterface $job): void
    {
        $this->jobs[] = $job;
    }

    /**
     * @return array<JobInterface>
     */
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

    /**
     * @return array<JobInterface>
     */
    public function getAllJobs(): array
    {
        return $this->jobs;
    }
}
