<?php

namespace Tests\Container;

class Incrementer
{
    protected int $i = 0;



    public function increment() : void
    {
        $this->i++;
    }



    public function getI() : int
    {
        return $this->i;
    }
}
