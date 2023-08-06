<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;

trait CsrfActions
{
    abstract public function grabContainer(): ContainerInterface;



    public function grabCsrfGenerator(): GeneratorInterface
    {
        $container = $this->grabContainer();

        return $container->get(GeneratorInterface::class);
    }

    public function grabCsrfStorage(): StorageInterface
    {
        $container = $this->grabContainer();

        return $container->get(StorageInterface::class);
    }



    public function getCsrfValue(): string
    {
        $csrfStorage = $this->grabCsrfStorage();

        return $csrfStorage->get();
    }

    public function resetCsrfValue(): void
    {
        $csrfStorage = $this->grabCsrfStorage();

        $csrfStorage->reset();
    }
}
