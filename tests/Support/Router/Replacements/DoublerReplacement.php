<?php

namespace Tests\Support\Router\Replacements;

use Centum\Interfaces\Router\ReplacementInterface;

class DoublerReplacement implements ReplacementInterface
{
    public function getIdentifier(): string
    {
        return "doubler";
    }

    public function getRegularExpression(): string
    {
        return "\d+";
    }

    public function filter(mixed $value): int
    {
        $value = (int) $value;

        return $value * 2;
    }
}
