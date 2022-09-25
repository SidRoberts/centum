<?php

namespace Centum\Http;

use Centum\Http\Exception\CsrfException;
use Centum\Interfaces\Container\ContainerInterface;

abstract class Form
{
    protected readonly Request $request;

    protected readonly Data $data;
    protected readonly Files $files;

    protected readonly Csrf $csrf;



    final public function __construct(Request $request, Csrf $csrf, ContainerInterface $container)
    {
        $this->request = $request;
        $this->data    = $request->getData();
        $this->files   = $request->getFiles();

        $this->csrf = $csrf;

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
