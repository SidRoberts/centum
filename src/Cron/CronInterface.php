<?php

namespace Centum\Cron;

use DateTime;

interface CronInterface
{
    public function add(JobInterface $job);

    public function getDueJobs(DateTime $now = null) : array;

    public function getAllJobs() : array;
}
