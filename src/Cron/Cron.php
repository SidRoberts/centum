<?php

namespace Centum\Cron;

use Centum\Interfaces\Cron\CronInterface;
use Centum\Interfaces\Cron\JobInterface;
use Cron\CronExpression;
use DateTimeImmutable;
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
                return $this->isDue($job, $datetime);
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



    protected function isDue(JobInterface $job, DateTimeInterface $datetime = null): bool
    {
        $cronExpression = new CronExpression(
            $job->getExpression()
        );

        if ($datetime === null) {
            $datetime = new DateTimeImmutable();
        }

        return $cronExpression->isDue($datetime);
    }
}
