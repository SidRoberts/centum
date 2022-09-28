<?php

namespace Centum\Http;

use Centum\Http\Exception\FileGroupAlreadyExistsException;
use Centum\Http\Exception\FileGroupNotFoundException;
use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FilesInterface;

class Files implements FilesInterface
{
    /** @var array<string, FileGroupInterface> */
    protected array $fileGroups = [];



    /**
     * @param FileGroupInterface[] $fileGroups
     */
    public function __construct(array $fileGroups = [])
    {
        foreach ($fileGroups as $fileGroup) {
            $this->add($fileGroup);
        }
    }



    public function add(FileGroupInterface $fileGroup): void
    {
        $id = $fileGroup->getID();

        if (isset($this->fileGroups[$id])) {
            throw new FileGroupAlreadyExistsException($id);
        }

        $this->fileGroups[$id] = $fileGroup;
    }



    public function has(string $id): bool
    {
        return isset($this->fileGroups[$id]);
    }

    public function get(string $id): FileGroupInterface
    {
        return $this->fileGroups[$id] ?? throw new FileGroupNotFoundException($id);
    }



    /**
     * @return array<string, FileGroupInterface>
     */
    public function all(): array
    {
        return $this->fileGroups;
    }

    public function toArray(): array
    {
        $fileGroups = [];

        foreach ($this->fileGroups as $id => $fileGroup) {
            $fileGroups[$id] = $fileGroup->toArray();
        }

        return $fileGroups;
    }
}
