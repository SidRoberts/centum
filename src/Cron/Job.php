<?php

namespace Centum\Cron;

use Cron\CronExpression;
use DateTime;

class Job implements JobInterface
{
    protected string $expression;

   protected $data;



    public function __construct(string $expression, $data)
    {
        $this->expression = $expression;
        $this->data       = $data;
    }



    public function getExpression() : string
    {
        return $this->expression;
    }

    public function getData()
    {
        return $this->data;
    }



    public function isDue(DateTime $datetime = null) : bool
    {
        $cronExpression = new CronExpression(
            $this->getExpression()
        );

        if ($datetime === null) {
            $datetime = new DateTime();
        }

        return $cronExpression->isDue($datetime);
    }
}
