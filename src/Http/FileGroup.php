<?php

namespace Centum\Http;

use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FileInterface;

class FileGroup implements FileGroupInterface
{
    /**
     * @var array<FileInterface>
     */
    protected array $files = [];



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



    /**
     * @return array<FileInterface>
     */
    public function all(): array
    {
        return $this->files;
    }

    /**
     * @return array<array{name: ?string, type: ?string, size: int, location: ?string, error: int}>
     */
    public function toArray(): array
    {
        $files = [];

        foreach ($this->files as $file) {
            $files[] = $file->toArray();
        }

        return $files;
    }
}
