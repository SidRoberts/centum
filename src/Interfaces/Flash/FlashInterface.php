<?php

namespace Centum\Interfaces\Flash;

interface FlashInterface
{
    public function success(string $text): void;

    public function info(string $text): void;

    public function warning(string $text): void;

    public function danger(string $text): void;



    public function output(): string;
}
