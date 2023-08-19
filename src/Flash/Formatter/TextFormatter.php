<?php

namespace Centum\Flash\Formatter;

use Centum\Interfaces\Flash\FormatterInterface;
use Centum\Interfaces\Flash\MessageInterface;

/**
 * ```
 * [DANGER] This is an example message.
 * ```
 */
class TextFormatter implements FormatterInterface
{
    public function output(MessageInterface $message): string
    {
        return sprintf(
            "[%s] %s",
            strtoupper($message->getLevel()),
            $message->getText()
        );
    }
}
