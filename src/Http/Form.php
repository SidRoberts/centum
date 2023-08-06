<?php

namespace Centum\Http;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FilesInterface;
use Centum\Interfaces\Http\RequestInterface;

abstract class Form
{
    protected readonly DataInterface $data;
    protected readonly FilesInterface $files;



    final public function __construct(
        protected readonly RequestInterface $request,
        protected readonly ValidatorInterface $csrfValidator,
        ContainerInterface $container
    ) {
        $this->data  = $request->getData();
        $this->files = $request->getFiles();

        $this->set($container);
    }

    abstract protected function set(ContainerInterface $container): void;



    protected function validateCsrf(): void
    {
        $this->csrfValidator->validate();
    }
}
