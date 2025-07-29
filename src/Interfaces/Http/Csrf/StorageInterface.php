<?php

namespace Centum\Interfaces\Http\Csrf;

interface StorageInterface
{
    public const string TOKEN = "centum-csrf";



    public function get(): string;

    public function set(string $newValue): void;

    public function reset(): void;
}
