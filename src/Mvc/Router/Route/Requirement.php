<?php

namespace Centum\Mvc\Router\Route;

use Attribute;
use InvalidArgumentException;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Requirement
{
    protected string $param;

    protected string $regEx;



    public function __construct(string $param, string $regEx)
    {
        $this->param = $param;
        $this->regEx = $regEx;
    }



    public function getParam() : string
    {
        return $this->param;
    }

    public function getRegEx() : string
    {
        return $this->regEx;
    }
}
