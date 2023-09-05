<?php

namespace Centum\Interfaces\Flash;

interface MessageInterface
{
    /**
     * @return non-empty-string
     */
    public function getLevel(): string;

    public function getText(): string;
}
