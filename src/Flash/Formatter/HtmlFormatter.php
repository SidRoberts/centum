<?php

namespace Centum\Flash\Formatter;

use Centum\Flash\Message;
use Centum\Interfaces\Flash\FormatterInterface;

class HtmlFormatter implements FormatterInterface
{
    public function output(Message $message): string
    {
        return sprintf(
            "<div class=\"alert alert-%s\">%s</div>",
            htmlspecialchars($message->getLevel(), \ENT_QUOTES, "UTF-8"),
            $message->getText()
        );
    }
}
