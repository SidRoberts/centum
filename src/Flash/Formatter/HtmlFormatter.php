<?php

namespace Centum\Flash\Formatter;

use Centum\Flash\FormatterInterface;

class HtmlFormatter implements FormatterInterface
{
    public function output(string $level, string $message) : string
    {
        return sprintf(
            "<div class=\"alert alert-%s\">%s</div>",
            $level,
            $message
        );
    }
}
