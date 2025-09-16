<?php

namespace Centum\Router\Replacements;

use Centum\Interfaces\Router\ReplacementInterface;

class CharacterReplacement implements ReplacementInterface
{
    public function getIdentifier(): string
    {
        return "char";
    }

    public function getRegularExpression(): string
    {
        return "[^/]";
    }

    public function process(string $value): string
    {
        return $value;
    }
}
