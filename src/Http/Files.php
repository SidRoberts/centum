<?php

namespace Centum\Http;

use Centum\Http\Exception\FileGroupAlreadyExistsException;
use Centum\Http\Exception\FileGroupNotFoundException;

class Files
{
    /**
     * @var array<string, FileGroup>
     */
    protected array $fileGroups = [];



    /**
     * @param FileGroup[] $fileGroups
     */
    public function __construct(array $fileGroups = [])
    {
        foreach ($fileGroups as $fileGroup) {
            $this->add($fileGroup);
        }
    }



    public function add(FileGroup $fileGroup): void
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

    public function get(string $id): FileGroup
    {
        return $this->fileGroups[$id] ?? throw new FileGroupNotFoundException($id);
    }



    /**
     * @return array<string, FileGroup>
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
