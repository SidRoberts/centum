<?php

namespace Centum\Interfaces\Logger;

interface LoggerInterface
{
    public function log(string $message): void;
}
