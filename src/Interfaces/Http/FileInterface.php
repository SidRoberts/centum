<?php

namespace Centum\Interfaces\Http;

interface FileInterface
{
    public function getName(): ?string;

    public function getType(): ?string;

    /**
     * @return non-negative-int
     */
    public function getSize(): int;

    public function getLocation(): ?string;

    public function getError(): int;



    public function isMoved(): bool;



    public function validate(): void;



    public function getExtension(): ?string;

    public function moveTo(string $path): bool;



    /**
     * @return array{name: ?string, type: ?string, size: int, location: ?string, error: int}
     */
    public function toArray(): array;
}
