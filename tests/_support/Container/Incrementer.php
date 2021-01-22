<?php

namespace Centum\Tests\Container;

class Incrementer
{
    protected int $i = 0;



    public function increment()
    {
        $this->i++;
    }



    public function getI() : int
    {
        return $this->i;
    }
}
