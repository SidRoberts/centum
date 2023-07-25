<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\CsrfInterface;

trait CsrfActions
{
    abstract public function grabContainer(): ContainerInterface;



    public function grabCsrf(): CsrfInterface
    {
        $container = $this->grabContainer();

        $csrf = $container->get(CsrfInterface::class);

        return $csrf;
    }

    public function getCsrfValue(): string
    {
        $csrf = $this->grabCsrf();

        return $csrf->get();
    }
}
