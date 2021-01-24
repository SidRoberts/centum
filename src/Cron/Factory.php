<?php

namespace Centum\Cron;

class Factory
{
    public static function buildFromArray(array $array) : Cron
    {
        $cron = new Cron();

        foreach ($array as $jobArray) {
            $expression = $jobArray[0];
            $data       = $jobArray[1];

            $job = new Job($expression, $data);

            $cron->add($job);
        }

        return $cron;
    }
}
