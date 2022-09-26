<?php

namespace Centum\Interfaces\Http;

interface CsrfInterface
{
    public function get(): string;

    public function generate(): string;

    public function reset(): void;



    public function validate(string $value): bool;
}
