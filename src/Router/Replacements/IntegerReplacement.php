<?php

namespace Centum\Router\Replacements;

use Centum\Interfaces\Router\ReplacementInterface;

class IntegerReplacement implements ReplacementInterface
{
    public function getIdentifier(): string
    {
        return "int";
    }

    public function getRegularExpression(): string
    {
        return "\d+";
    }

    public function process(string $value): int
    {
        return (int) $value;
    }
}
