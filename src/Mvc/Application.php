<?php

namespace Centum\Mvc;

use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Router\Exception\RouteNotFoundException;
use Centum\Mvc\Router\RouterMatch;

class Application
{
    protected Router $router;

    protected Dispatcher $dispatcher;

    protected ?Path $notFoundPath = null;



    public function __construct(Router $router, Dispatcher $dispatcher)
    {
        $this->router     = $router;
        $this->dispatcher = $dispatcher;
    }



    public function getNotFoundPath() : ?Path
    {
        return $this->notFoundPath;
    }

    public function setNotFoundPath(Path $notFoundPath)
    {
        $this->notFoundPath = $notFoundPath;
    }



    public function handle(Request $request) : Response
    {
        try {
            $match = $this->router->handle(
                $request->getRequestUri(),
                $request->getMethod()
            );
        } catch (RouteNotFoundException $e) {
            if ($this->notFoundPath === null) {
                throw $e;
            }

            $match = new RouterMatch(
                $this->notFoundPath,
                []
            );
        }



        $returnedValue = $this->dispatcher->dispatch(
            $match->getPath(),
            $match->getParams()
        );



        if ($returnedValue instanceof Response) {
            return $returnedValue;
        }



        $response = new Response();

        $response->setContent(
            $returnedValue
        );

        return $response;
    }
}
