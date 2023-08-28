<?php

namespace Centum\Access;

use Centum\Access\Exception\AccessDeniedException;
use Centum\Interfaces\Access\AccessInterface;
use Centum\Interfaces\Access\ActivityInterface;

class Access implements AccessInterface
{
    public const ALLOW = true;
    public const DENY  = false;



    /** @var array<non-empty-string, ActivityInterface> */
    protected array $activities = [];



    public function __construct(
        protected readonly bool $default = self::ALLOW
    ) {
    }



    public function getDefault(): bool
    {
        return $this->default;
    }



    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function allow(string $user, string $activityName): void
    {
        $activity = $this->getActivity($activityName);

        $activity->allow($user);
    }

    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function deny(string $user, string $activityName): void
    {
        $activity = $this->getActivity($activityName);

        $activity->deny($user);
    }

    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function remove(string $user, string $activityName): void
    {
        $activity = $this->getActivity($activityName);

        $activity->remove($user);
    }



    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function isAllowed(string $user, string $activityName): bool
    {
        $activity = $this->getActivity($activityName);

        return $activity->isAllowed($user);
    }

    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function verify(string $user, string $activityName): void
    {
        if (!$this->isAllowed($user, $activityName)) {
            throw new AccessDeniedException($user, $activityName);
        }
    }



    /**
     * @param non-empty-string $name
     */
    protected function getActivity(string $name): ActivityInterface
    {
        if (!isset($this->activities[$name])) {
            $this->activities[$name] = new Activity($name, $this->default);
        }

        return $this->activities[$name];
    }
}
