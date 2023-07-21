<?php

namespace Centum\Container\Exception;

use Exception;

class InstantiateInterfaceException extends Exception
{
    /**
     * @param interface-string $interface
     */
    public function __construct(
        protected readonly string $interface
    ) {
        parent::__construct(
            sprintf(
                "Cannot instantiate an interface (%s).",
                $interface
            )
        );
    }



    /**
     * @return interface-string
     */
    public function getInterface(): string
    {
        return $this->interface;
    }
}
