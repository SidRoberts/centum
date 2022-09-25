<?php

namespace Centum\Interfaces\Flash;

interface MessageInterface
{
    public function getLevel(): string;

    public function getText(): string;
}
