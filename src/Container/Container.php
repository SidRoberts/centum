<?php

namespace Centum\Container;

use Centum\Container\Exception\ServiceNotFoundException;

class Container
{
    protected array $services = [];

    protected array $sharedServices = [];

    protected Resolver $resolver;



    public function __construct()
    {
        $this->resolver = new Resolver($this);
    }



    public function getResolver() : Resolver
    {
        return $this->resolver;
    }



    public function get(string $name) : mixed
    {
        if (isset($this->sharedServices[$name])) {
            return $this->sharedServices[$name];
        }

        if (!isset($this->services[$name])) {
            throw new ServiceNotFoundException($name);
        }



        $service = $this->services[$name];

        $resolvedService = $this->resolver->typehintService($service);

        if ($service->isShared()) {
            $this->sharedServices[$name] = $resolvedService;
        }

        return $resolvedService;
    }

    public function set(string $name, mixed $value) : void
    {
        $this->sharedServices[$name] = $value;
    }



    public function add(Service $service) : self
    {
        $name = $service->getName();

        $this->services[$name] = $service;

        return $this;
    }



    public function has(string $name) : bool
    {
        return isset($this->services[$name]) || isset($this->sharedServices[$name]);
    }
}
