<?php

namespace Centum\Interfaces\Http\Csrf;

interface GeneratorInterface
{
    public const int LENGTH = 32;



    public function generate(): string;
}
