<?php

namespace Centum\Http;

use Centum\Container\Container;
use Exception;

abstract class Form
{
    protected Request $request;

    protected Data $data;
    protected Files $files;

    protected Csrf $csrf;



    final public function __construct(Request $request, Csrf $csrf, Container $container)
    {
        $this->request = $request;
        $this->data    = $request->getData();
        $this->files   = $request->getFiles();

        $this->csrf = $csrf;

        $this->set($container);
    }

    abstract protected function set(Container $container): void;



    protected function validateCsrf(): void
    {
        /** @var string|null */
        $value = $this->data->get("csrf");

        if (!$value || !$this->csrf->validate($value)) {
            throw new Exception("CSRF does not match.");
        }
    }
}
