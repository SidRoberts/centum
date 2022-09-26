<?php

namespace Centum\Cron;

use Centum\Interfaces\Cron\JobInterface;
use Cron\CronExpression;
use DateTimeImmutable;
use DateTimeInterface;

class Job implements JobInterface
{
    protected readonly string $expression;

    protected readonly mixed $data;



    public function __construct(string $expression, mixed $data)
    {
        $this->expression = $expression;
        $this->data       = $data;
    }



    public function getExpression(): string
    {
        return $this->expression;
    }

    public function getData(): mixed
    {
        return $this->data;
    }



    public function isDue(DateTimeInterface $datetime = null): bool
    {
        $cronExpression = new CronExpression(
            $this->getExpression()
        );

        if ($datetime === null) {
            $datetime = new DateTimeImmutable();
        }

        return $cronExpression->isDue($datetime);
    }
}
