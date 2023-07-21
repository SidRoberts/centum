<?php

namespace Centum\Access;

use Centum\Interfaces\Access\AccessInterface;
use Centum\Interfaces\Access\ActivityInterface;

class Access implements AccessInterface
{
    public const ALLOW = true;
    public const DENY  = false;



    /** @var array<string, ActivityInterface> */
    protected array $activities = [];



    public function __construct(
        protected readonly bool $default = self::ALLOW
    ) {
    }



    public function getDefault(): bool
    {
        return $this->default;
    }



    public function allow(string $user, string $activityName): void
    {
        $activity = $this->getActivity($activityName);

        $activity->allow($user);
    }

    public function deny(string $user, string $activityName): void
    {
        $activity = $this->getActivity($activityName);

        $activity->deny($user);
    }

    public function remove(string $user, string $activityName): void
    {
        $activity = $this->getActivity($activityName);

        $activity->remove($user);
    }



    public function isAllowed(string $user, string $activityName): bool
    {
        $activity = $this->getActivity($activityName);

        return $activity->isAllowed($user);
    }



    protected function getActivity(string $name): ActivityInterface
    {
        if (!isset($this->activities[$name])) {
            $this->activities[$name] = new Activity($name, $this->default);
        }

        return $this->activities[$name];
    }
}
