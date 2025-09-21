<?php

namespace Centum\Http;

use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FileInterface;

class FileGroup implements FileGroupInterface
{
    /**
     * @var list<FileInterface>
     */
    protected array $files = [];



    /**
     * @param non-empty-string $id
     */
    public function __construct(
        protected readonly string $id
    ) {
    }



    public function getID(): string
    {
        return $this->id;
    }



    public function add(FileInterface $file): void
    {
        $this->files[] = $file;
    }



    public function all(): array
    {
        return $this->files;
    }

    public function toArray(): array
    {
        $files = [];

        foreach ($this->files as $file) {
            $files[] = $file->toArray();
        }

        return $files;
    }
}
