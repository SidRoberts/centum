<?php

namespace Centum\Flash\Formatter;

use Centum\Flash\FormatterInterface;
use Centum\Flash\Message;

class HtmlFormatter implements FormatterInterface
{
    public function output(Message $message) : string
    {
        return sprintf(
            "<div class=\"alert alert-%s\">%s</div>",
            $message->getLevel(),
            $message->getText()
        );
    }
}
