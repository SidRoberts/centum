<?php

namespace Centum\Interfaces\Container;

/**
 * @template T of object
 */
interface ServiceInterface
{
    /**
     * @return T
     */
    public function build(): object;
}
