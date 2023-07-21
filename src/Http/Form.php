<?php

namespace Centum\Http;

use Centum\Http\Exception\CsrfException;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\CsrfInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FilesInterface;
use Centum\Interfaces\Http\RequestInterface;

abstract class Form
{
    protected readonly DataInterface $data;
    protected readonly FilesInterface $files;



    final public function __construct(
        protected readonly RequestInterface $request,
        protected readonly CsrfInterface $csrf,
        ContainerInterface $container
    ) {
        $this->data  = $request->getData();
        $this->files = $request->getFiles();

        $this->set($container);
    }

    abstract protected function set(ContainerInterface $container): void;



    protected function validateCsrf(): void
    {
        /** @var string|null */
        $value = $this->data->get("csrf");

        if (!$value || !$this->csrf->validate($value)) {
            throw new CsrfException($value);
        }
    }
}
