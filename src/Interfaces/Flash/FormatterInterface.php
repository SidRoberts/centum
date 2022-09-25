<?php

namespace Centum\Interfaces\Flash;

interface FormatterInterface
{
    public function output(MessageInterface $message): string;
}
