<?php

namespace Centum\Codeception;

use Centum\Container\Container;
use Centum\Http\RequestFactory;
use Centum\Http\Session\ArrayHandler;
use Centum\Http\Session\HandlerInterface;
use Centum\Mvc\Router;
use Symfony\Component\BrowserKit\AbstractBrowser as Client;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\BrowserKit\History;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;

class Connector extends Client
{
    protected Container $container;



    public function __construct(Container $container, array $server = [], History $history = null, CookieJar $cookieJar = null)
    {
        $container->setDynamic(
            HandlerInterface::class,
            function () {
                return new ArrayHandler();
            }
        );

        $this->container = $container;

        parent::__construct($server, $history, $cookieJar);
    }



    /**
     * @param BrowserKitRequest $request
     *
     * @return BrowserKitResponse
     *
     * @psalm-suppress all
     */
    public function doRequest($request)
    {
        /**
         * @var Router
         */
        $router = $this->container->typehintClass(Router::class);

        $centumRequest = RequestFactory::createFromBrowserKitRequest($request);

        $centumResponse = $router->handle($centumRequest);

        return new BrowserKitResponse(
            $centumResponse->getContent(),
            $centumResponse->getStatus()->getCode(),
            $centumResponse->getHeaders()->toArray()
        );
    }
}
