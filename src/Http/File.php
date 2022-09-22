<?php

namespace Centum\Http;

use Centum\Http\Exception\FileAlreadyMovedException;
use Exception;

class File
{
    protected readonly ?string $name;
    protected readonly ?string $type;
    protected readonly int $size;
    protected ?string $location;
    protected readonly int $error;

    protected bool $isMoved = false;



    public function __construct(?string $name, ?string $type, int $size, ?string $location, int $error)
    {
        $this->name     = $name;
        $this->type     = $type;
        $this->size     = $size;
        $this->location = $location;
        $this->error    = $error;
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function getError(): int
    {
        return $this->error;
    }



    public function isMoved(): bool
    {
        return $this->isMoved;
    }



    public function getExtension(): ?string
    {
        if ($this->error !== UPLOAD_ERR_OK || $this->name === null) {
            throw new Exception("File has an error.");
        }

        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    public function moveTo(string $path): bool
    {
        if ($this->error !== UPLOAD_ERR_OK || $this->location === null) {
            throw new Exception("File has an error.");
        }

        if ($this->isMoved) {
            throw new FileAlreadyMovedException($this);
        }

        $this->isMoved = true;

        return move_uploaded_file($this->location, $path);
    }



    public function toArray(): array
    {
        return [
            "name"     => $this->name,
            "type"     => $this->type,
            "size"     => $this->size,
            "location" => $this->location,
            "error"    => $this->error,
        ];
    }
}
