<?php

namespace Centum\Cron;

use Centum\Interfaces\Cron\CronInterface;
use Centum\Interfaces\Cron\JobInterface;
use Cron\CronExpression;
use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;

class Cron implements CronInterface
{
    /**
     * @var array<JobInterface>
     */
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
                return $this->isDue($job, $datetime);
            }
        );

        return $jobs;
    }

    public function getAllJobs(): array
    {
        return $this->jobs;
    }



    /**
     * @throws InvalidArgumentException
     */
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
