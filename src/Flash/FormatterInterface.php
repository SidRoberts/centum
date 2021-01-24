<?php

namespace Centum\Flash;

interface FormatterInterface
{
    public function output(string $level, string $message) : string;
}
