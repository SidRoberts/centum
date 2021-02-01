<?php

namespace Centum\Flash;

interface FlashInterface
{
    public function success(string $message) : void;

    public function info(string $message) : void;

    public function warning(string $message) : void;

    public function danger(string $message) : void;



    public function output() : string;
}
