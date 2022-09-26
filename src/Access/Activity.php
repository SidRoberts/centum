<?php

namespace Centum\Access;

use Centum\Interfaces\Access\ActivityInterface;

class Activity implements ActivityInterface
{
    protected readonly string $name;

    protected readonly bool $default;

    /** @var array<string, bool> */
    protected array $users = [];



    public function __construct(string $name, bool $default = Access::ALLOW)
    {
        $this->name    = $name;
        $this->default = $default;
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
