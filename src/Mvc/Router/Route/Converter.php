<?php

namespace Centum\Mvc\Router\Route;

use Attribute;
use InvalidArgumentException;
use Centum\Mvc\ConverterInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Converter
{
    protected string $param;

    protected string $converter;



    public function __construct(string $param, string $converter)
    {
        if (!is_subclass_of($converter, ConverterInterface::class)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Converter must implement %s",
                    ConverterInterface::class
                )
            );
        }

        $this->param = $param;
        $this->converter = $converter;
    }



    public function getParam() : string
    {
        return $this->param;
    }

    public function getConverter() : string
    {
        return $this->converter;
    }
}
