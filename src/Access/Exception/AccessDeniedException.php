<?php

namespace Centum\Access\Exception;

class AccessDeniedException extends \Exception
{
    public function __construct(
        protected readonly string $user,
        protected readonly string $activityName
    ) {
    }



    public function getUser(): string
    {
        return $this->user;
    }

    public function getActivityName(): string
    {
        return $this->activityName;
    }
}
