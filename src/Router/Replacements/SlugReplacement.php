<?php

namespace Centum\Router\Replacements;

use Centum\Interfaces\Router\ReplacementInterface;

class SlugReplacement implements ReplacementInterface
{
    public function getIdentifier(): string
    {
        return "slug";
    }

    public function getRegularExpression(): string
    {
        return "[a-z0-9]+(?:\-[a-z0-9]+)*";
    }

    public function process(string $value): string
    {
        return $value;
    }
}
