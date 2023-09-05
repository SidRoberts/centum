<?php

namespace Centum\Interfaces\Router;

interface ReplacementInterface
{
    /**
     * @return non-empty-string
     */
    public function getIdentifier(): string;

    /**
     * @return non-empty-string
     */
    public function getRegularExpression(): string;

    public function filter(string $value): mixed;
}
