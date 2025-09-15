<?php

namespace Centum\Router\Replacements;

use Centum\Interfaces\Router\ReplacementInterface;

class Uuid4Replacement implements ReplacementInterface
{
    public function getIdentifier(): string
    {
        return "uuid4";
    }

    public function getRegularExpression(): string
    {
        return "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}";
    }

    public function filter(string $value): string
    {
        return $value;
    }
}
