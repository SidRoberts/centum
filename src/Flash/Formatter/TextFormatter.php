<?php

namespace Centum\Flash\Formatter;

use Centum\Interfaces\Flash\FormatterInterface;
use Centum\Interfaces\Flash\MessageInterface;

/**
 * ```text
 * [DANGER] This is an example message.
 * ```
 */
class TextFormatter implements FormatterInterface
{
    public function output(MessageInterface $message): string
    {
        return sprintf(
            "[%s] %s",
            mb_strtoupper($message->getLevel()),
            $message->getText()
        );
    }
}
