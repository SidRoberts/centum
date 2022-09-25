<?php

namespace Centum\Flash\Formatter;

use Centum\Flash\Message;
use Centum\Interfaces\Flash\FormatterInterface;

class TextFormatter implements FormatterInterface
{
    public function output(Message $message): string
    {
        return sprintf(
            "[%s] %s",
            strtoupper($message->getLevel()),
            $message->getText()
        );
    }
}
