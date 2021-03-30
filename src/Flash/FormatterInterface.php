<?php

namespace Centum\Flash;

interface FormatterInterface
{
    public function output(Message $message): string;
}
