<?php

namespace Centum\Interfaces\Http;

interface CookieInterface
{
    public function getName(): string;

    public function getValue(): string;



    public function getHeaderString(): string;



    public function send(): void;



    public function __toString(): string;
}
