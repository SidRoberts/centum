<?php

namespace Centum\Cron;

use DateTime;

class Cron
{
    /**
     * @var JobInterface[] $jobs
     */
    protected array $jobs = [];



    public function add(JobInterface $job) : void
    {
        $this->jobs[] = $job;
    }

    public function getDueJobs(DateTime $now = null) : array
    {
        $jobs = array_filter(
            $this->jobs,
            function (JobInterface $job) use ($now) : bool {
                return $job->isDue($now);
            }
        );

        return $jobs;
    }

    public function getAllJobs() : array
    {
        return $this->jobs;
    }
}
