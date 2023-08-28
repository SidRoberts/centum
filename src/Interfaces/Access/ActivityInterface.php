<?php

namespace Centum\Interfaces\Access;

interface ActivityInterface
{
    /**
     * @return non-empty-string
     */
    public function getName(): string;



    /**
     * @param non-empty-string $user
     */
    public function allow(string $user): void;

    /**
     * @param non-empty-string $user
     */
    public function deny(string $user): void;

    /**
     * @param non-empty-string $user
     */
    public function remove(string $user): void;



    /**
     * @param non-empty-string $user
     */
    public function isAllowed(string $user): bool;
}
