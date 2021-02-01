<?php

namespace Centum\Container;

use Closure;

class RawService extends Service
{
    protected string $name;

    protected bool $isShared;

    protected Closure $closure;



    public function __construct(string $name, bool $isShared, Closure $closure)
    {
        $this->name     = $name;
        $this->isShared = $isShared;
        $this->closure  = $closure;
    }



    public function getName() : string
    {
        return $this->name;
    }

    public function isShared() : bool
    {
        return $this->isShared;
    }

    public function resolve(Container $container) : mixed
    {
        $closure = $this->closure;

        return $closure($container);
    }
}
