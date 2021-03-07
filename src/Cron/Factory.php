<?php

namespace Centum\Cron;

class Factory
{
    public static function buildFromArray(array $array) : Cron
    {
        $cron = new Cron();

        /**
         * @var array $jobArray
         */
        foreach ($array as $jobArray) {
            /**
             * @var string
             */
            $expression = $jobArray[0];

            /**
             * @var mixed
             */
            $data = $jobArray[1];

            $job = new Job($expression, $data);

            $cron->add($job);
        }

        return $cron;
    }
}
