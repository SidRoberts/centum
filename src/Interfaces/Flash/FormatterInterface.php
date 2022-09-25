<?php

namespace Centum\Interfaces\Flash;

use Centum\Flash\Message;

interface FormatterInterface
{
    public function output(Message $message): string;
}
