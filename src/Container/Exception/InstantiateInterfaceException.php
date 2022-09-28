<?php

namespace Centum\Container\Exception;

use Exception;

class InstantiateInterfaceException extends Exception
{
    /** @var interface-string */
    protected string $interface;



    /**
     * @param interface-string $interface
     */
    public function __construct(string $interface)
    {
        $this->interface = $interface;

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
