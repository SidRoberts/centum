<?php

namespace Centum\Tests\Container\Services;

use Centum\Container\Service;
use Centum\Tests\Container\Incrementer;

class IncrementerService extends Service
{
    protected bool $isShared;



    public function __construct(bool $isShared)
    {
        $this->isShared = $isShared;
    }



    public function getName() : string
    {
        return "incrementer";
    }

    public function isShared() : bool
    {
        return $this->isShared;
    }

    public function resolve()
    {
        $incrementer = new Incrementer();

        return $incrementer;
    }
}
