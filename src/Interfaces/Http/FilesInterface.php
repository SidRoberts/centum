<?php

namespace Centum\Interfaces\Http;

interface FilesInterface
{
    public function add(FileGroupInterface $fileGroup): void;



    /**
     * @param non-empty-string $id
     */
    public function has(string $id): bool;

    /**
     * @param non-empty-string $id
     */
    public function get(string $id): FileGroupInterface;



    /**
     * @return array<non-empty-string, FileGroupInterface>
     */
    public function all(): array;

    /**
     * @return array<non-empty-string, array<array{name: ?string, type: ?string, size: int, location: ?string, error: int}>>
     */
    public function toArray(): array;
}
