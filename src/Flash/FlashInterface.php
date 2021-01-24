<?php

namespace Centum\Flash;

interface FlashInterface
{
    public function success(string $message);

    public function info(string $message);

    public function warning(string $message);

    public function danger(string $message);



    public function output() : string;
}
