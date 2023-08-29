<?php

namespace Centum\Interfaces\Cron;

interface JobInterface
{
    public function getExpression(): string;

    public function getData(): mixed;
}
