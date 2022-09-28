<?php

namespace Centum\Interfaces\Http;

interface FileGroupInterface
{
    public function getID(): string;



    public function add(FileInterface $file): void;



    /**
     * @return array<FileInterface>
     */
    public function all(): array;

    public function toArray(): array;
}
