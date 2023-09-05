<?php

namespace Centum\Interfaces\Cron;

interface JobInterface
{
    /**
     * @return non-empty-string
     */
    public function getExpression(): string;

    public function getData(): mixed;
}
