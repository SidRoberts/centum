<?php

namespace Centum\Access;

use Centum\Interfaces\Access\ActivityInterface;

class Activity implements ActivityInterface
{
    /**
     * @var array<non-empty-string, bool>
     */
    protected array $users = [];



    /**
     * @param non-empty-string $name
     */
    public function __construct(
        protected readonly string $name,
        protected readonly bool $default = Access::ALLOW
    ) {
    }



    public function getName(): string
    {
        return $this->name;
    }



    public function allow(string $user): void
    {
        $this->users[$user] = Access::ALLOW;
    }

    public function deny(string $user): void
    {
        $this->users[$user] = Access::DENY;
    }

    public function remove(string $user): void
    {
        unset(
            $this->users[$user]
        );
    }



    public function isAllowed(string $user): bool
    {
        if (!isset($this->users[$user])) {
            return ($this->default === Access::ALLOW);
        }

        return ($this->users[$user] === Access::ALLOW);
    }
}
