<?php

namespace Centum\Http;

use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FileInterface;

class FileGroup implements FileGroupInterface
{
    protected readonly string $id;

    /** @var array<FileInterface> */
    protected array $files = [];



    public function __construct(string $id)
    {
        $this->id = $id;
    }



    public function getID(): string
    {
        return $this->id;
    }



    public function add(FileInterface $file): void
    {
        $this->files[] = $file;
    }



    /**
     * @return array<FileInterface>
     */
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
