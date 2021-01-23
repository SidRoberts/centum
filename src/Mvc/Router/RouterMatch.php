<?php

namespace Centum\Mvc\Router;

use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Parameters;

class RouterMatch
{
    protected Path $path;

    protected array $params;



    public function __construct(Path $path, array $params)
    {
        $this->path   = $path;
        $this->params = $params;
    }



    public function getPath() : Path
    {
        return $this->path;
    }

    public function getParams() : Parameters
    {
        return new Parameters($this->params);
    }
}
