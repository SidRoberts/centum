<?php

namespace Centum\Cron;

use Centum\Interfaces\Cron\CronInterface;

class CronFactory
{
    public static function createFromArray(array $array): CronInterface
    {
        $cron = new Cron();

        /** @var array $jobArray */
        foreach ($array as $jobArray) {
            /** @var string */
            $expression = $jobArray[0];

            /** @var mixed */
            $data = $jobArray[1];

            $job = new Job($expression, $data);

            $cron->add($job);
        }

        return $cron;
    }
}
