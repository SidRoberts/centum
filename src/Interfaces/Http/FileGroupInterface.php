<?php

namespace Centum\Interfaces\Http;

interface FileGroupInterface
{
    /**
     * @return non-empty-string
     */
    public function getID(): string;



    public function add(FileInterface $file): void;



    /**
     * @return list<FileInterface>
     */
    public function all(): array;

    /**
     * @return list<array{name: ?string, type: ?string, size: int, location: ?string, error: int}>
     */
    public function toArray(): array;
}
