<?php

namespace Centum\Flash\Formatter;

use Centum\Interfaces\Flash\FormatterInterface;
use Centum\Interfaces\Flash\MessageInterface;

/**
 * ```html
 * <div class="alert alert-danger">This is an example message.</div>
 * ```
 */
class HtmlFormatter implements FormatterInterface
{
    public function output(MessageInterface $message): string
    {
        return sprintf(
            "<div class=\"alert alert-%s\">%s</div>",
            htmlspecialchars($message->getLevel(), \ENT_QUOTES, "UTF-8"),
            $message->getText()
        );
    }
}
