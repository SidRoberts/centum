<?php

namespace Centum\Access;

class Access
{
    const ALLOW = true;
    const DENY = false;



    protected bool $default;

    protected array $access = [];



    public function __construct(bool $default = self::ALLOW)
    {
        $this->default = $default;
    }



    public function allow(string $user, string $activity)
    {
        if (!isset($this->access[$activity])) {
            $this->access[$activity] = [];
        }

        $this->access[$activity][$user] = self::ALLOW;
    }

    public function deny(string $user, string $activity)
    {
        if (!isset($this->access[$activity])) {
            $this->access[$activity] = [];
        }

        $this->access[$activity][$user] = self::DENY;
    }

    public function remove(string $user, string $activity)
    {
        unset(
            $this->access[$activity][$user]
        );

        if (empty($this->access[$activity])) {
            unset(
                $this->access[$activity]
            );
        }
    }



    public function isAllowed(string $user, string $activity) : bool
    {
        if (!isset($this->access[$activity][$user])) {
            return ($this->default === self::ALLOW);
        }

        return ($this->access[$activity][$user] === self::ALLOW);
    }
}
