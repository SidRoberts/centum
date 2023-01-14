<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\CsrfInterface;

trait CsrfActions
{
    abstract public function grabContainer(): ContainerInterface;



    public function getCsrfValue(): string
    {
        $container = $this->grabContainer();

        $csrf = $container->get(CsrfInterface::class);

        return $csrf->get();
    }
}
