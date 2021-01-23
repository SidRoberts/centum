<?php

namespace Centum\Mvc\Router\Route;

use Attribute;

#[Attribute]
class Requirements
{
    protected array $requirements = [];



    public function __construct(array $requirements)
    {
        $this->requirements = $requirements;
    }



    public function toArray() : array
    {
        return $this->requirements;
    }
}
