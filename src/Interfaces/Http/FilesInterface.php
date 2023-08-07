<?php

namespace Centum\Interfaces\Http;

interface FilesInterface
{
    public function add(FileGroupInterface $fileGroup): void;



    public function has(string $id): bool;

    public function get(string $id): FileGroupInterface;



    /**
     * @return array<string, FileGroupInterface>
     */
    public function all(): array;

    /**
     * @return array<string, array<array{name: ?string, type: ?string, size: int, location: ?string, error: int}>>
     */
    public function toArray(): array;
}
