<?php

namespace Tests\Support\Container\Services;

use Centum\Interfaces\Container\ServiceInterface;
use Tests\Support\Container\Incrementer;

/**
 * @implements ServiceInterface<Incrementer>
 */
final class IncrementerService implements ServiceInterface
{
    public function build(): Incrementer
    {
        $incrementer = new Incrementer();

        $incrementer->increment();
        $incrementer->increment();

        return $incrementer;
    }
}
