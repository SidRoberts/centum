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

    public function filter(string $value): mixed
    {
        return $value;
    }
}
