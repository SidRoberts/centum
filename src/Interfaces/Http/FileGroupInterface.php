<?php

namespace Centum\Interfaces\Http;

use Centum\Http\File;

interface FileGroupInterface
{
    public function getID(): string;



    public function add(File $file): void;



    /**
     * @return array<File>
     */
    public function all(): array;

    public function toArray(): array;
}
