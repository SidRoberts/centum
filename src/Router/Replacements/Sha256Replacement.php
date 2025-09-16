<?php

namespace Centum\Router\Replacements;

use Centum\Interfaces\Router\ReplacementInterface;

class Sha256Replacement implements ReplacementInterface
{
    public function getIdentifier(): string
    {
        return "sha256";
    }

    public function getRegularExpression(): string
    {
        return "[0-9a-f]{64}";
    }

    public function process(string $value): string
    {
        return $value;
    }
}
