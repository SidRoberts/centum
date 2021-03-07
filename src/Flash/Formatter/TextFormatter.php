<?php

namespace Centum\Flash\Formatter;

use Centum\Flash\FormatterInterface;
use Centum\Flash\Message;

class TextFormatter implements FormatterInterface
{
    public function output(Message $message) : string
    {
        return sprintf(
            "[%s] %s",
            strtoupper($message->getLevel()),
            $message->getText()
        );
    }
}
