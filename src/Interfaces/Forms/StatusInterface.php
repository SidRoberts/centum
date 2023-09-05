<?php

namespace Centum\Interfaces\Forms;

interface StatusInterface
{
    public function isValid(): bool;

    /**
     * @return array<non-empty-string, array<non-empty-string>>
     */
    public function getMessages(): array;
}
