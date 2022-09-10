<?php

namespace Centum\Http;

use Centum\Container\Container;

abstract class Form
{
    protected Request $request;

    protected Data $data;
    protected Files $files;



    final public function __construct(Request $request, Container $container)
    {
        $this->request = $request;
        $this->data    = $request->getData();
        $this->files   = $request->getFiles();

        $this->set($container);
    }

    abstract protected function set(Container $container): void;
}
