<?php

namespace Centum\Interfaces\Forms;

interface StatusInterface
{
    public function isValid(): bool;

    /**
     * @return array<string, string[]>
     */
    public function getMessages(): array;
}
