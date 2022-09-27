<?php

namespace Centum\Interfaces\Http;

use Centum\Http\FileGroup;

interface FilesInterface
{
    public function add(FileGroup $fileGroup): void;



    public function has(string $id): bool;

    public function get(string $id): FileGroup;



    /**
     * @return array<string, FileGroup>
     */
    public function all(): array;

    public function toArray(): array;
}
