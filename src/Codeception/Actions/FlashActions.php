<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Flash\FlashInterface;

/**
 * Flash Actions
 */
trait FlashActions
{
    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
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
