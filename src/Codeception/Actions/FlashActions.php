<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Flash\FlashInterface;

trait FlashActions
{
    /**
     * @template T of object
     * @psalm-param interface-string<T>|class-string<T> $class
     * @psalm-return T
     */
    abstract public function grabFromContainer(string $class): object;



    /**
     * Grab the Flash from the Container.
     */
    public function grabFlash(): FlashInterface
    {
        return $this->grabFromContainer(FlashInterface::class);
    }
}
