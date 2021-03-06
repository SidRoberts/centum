<?php

namespace Centum\Access;

class Access
{
    const ALLOW = true;
    const DENY = false;



    protected bool $default;

    /**
     * @var array<string, Activity>
     */
    protected array $activities = [];



    public function __construct(bool $default = self::ALLOW)
    {
        $this->default = $default;
    }



    public function allow(string $user, string $activityName) : void
    {
        $activity = $this->getActivity($activityName);

        $activity->allow($user);
    }

    public function deny(string $user, string $activityName) : void
    {
        $activity = $this->getActivity($activityName);

        $activity->deny($user);
    }

    public function remove(string $user, string $activityName) : void
    {
        $activity = $this->getActivity($activityName);

        $activity->remove($user);
    }



    public function isAllowed(string $user, string $activityName) : bool
    {
        $activity = $this->getActivity($activityName);

        return $activity->isAllowed($user);
    }



    protected function getActivity(string $name) : Activity
    {
        if (!isset($this->activities[$name])) {
            $this->activities[$name] = new Activity($name, $this->default);
        }

        return $this->activities[$name];
    }
}
