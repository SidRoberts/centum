<?php

namespace Centum\Flash\Formatter;

use Centum\Flash\FormatterInterface;

class TextFormatter implements FormatterInterface
{
    public function output(string $level, string $message) : string
    {
        return sprintf(
            "[%s] %s",
            strtoupper($level),
            $message
        );
    }
}
