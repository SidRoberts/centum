<?php

namespace Centum\Interfaces\Http\Csrf;

interface GeneratorInterface
{
    public const LENGTH = 32;



    public function generate(): string;
}
