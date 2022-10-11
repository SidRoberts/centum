<?php

namespace Centum\Cron;

use Centum\Interfaces\Cron\CronInterface;

class CronFactory
{
    /**
     * @param array<array{0: string, 1: mixed}> $array
     */
    public function createFromArray(array $array): CronInterface
    {
        $cron = new Cron();

        foreach ($array as $jobArray) {
            $expression = $jobArray[0];

            /** @var mixed */
            $data = $jobArray[1];

            $job = new Job($expression, $data);

            $cron->add($job);
        }

        return $cron;
    }
}
