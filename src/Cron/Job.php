<?php

namespace Centum\Cron;

use Centum\Interfaces\Cron\JobInterface;

class Job implements JobInterface
{
    public function __construct(
        protected readonly string $expression,
        protected readonly mixed $data
    ) {
    }



    public function getExpression(): string
    {
        return $this->expression;
    }

    public function getData(): mixed
    {
        return $this->data;
    }
}
