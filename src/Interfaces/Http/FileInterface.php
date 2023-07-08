<?php

namespace Centum\Interfaces\Http;

interface FileInterface
{
    public function getName(): ?string;

    public function getType(): ?string;

    public function getSize(): int;

    public function getLocation(): ?string;

    public function getError(): int;



    public function isMoved(): bool;



    public function validate(): void;



    public function getExtension(): ?string;

    public function moveTo(string $path): bool;



    public function toArray(): array;
}
