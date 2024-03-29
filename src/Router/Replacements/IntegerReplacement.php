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

    public function filter(string $value): mixed
    {
        return (int) $value;
    }
}
