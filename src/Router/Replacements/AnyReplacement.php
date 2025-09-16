<?php

namespace Centum\Router\Replacements;

use Centum\Interfaces\Router\ReplacementInterface;

class AnyReplacement implements ReplacementInterface
{
    public function getIdentifier(): string
    {
        return "any";
    }

    public function getRegularExpression(): string
    {
        return "[^/]+";
    }

    public function process(string $value): string
    {
        return $value;
    }
}
