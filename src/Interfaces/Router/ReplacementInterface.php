<?php

namespace Centum\Interfaces\Router;

interface ReplacementInterface
{
    public function getIdentifier(): string;

    public function getRegularExpression(): string;

    public function filter(string $value): mixed;
}
