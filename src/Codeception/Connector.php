<?php

namespace Centum\Codeception;

use Centum\Http\RequestFactory;
use Centum\Http\Session\ArraySession;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\SessionInterface;
use Centum\Interfaces\Router\RouterInterface;
use Symfony\Component\BrowserKit\AbstractBrowser as Client;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\BrowserKit\History;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;

class Connector extends Client
{
    protected ContainerInterface $container;



    public function __construct(
        ContainerInterface $container,
        array $server = [],
        History $history = null,
        CookieJar $cookieJar = null
    ) {
        $container->addAlias(
            SessionInterface::class,
            ArraySession::class
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
        $router = $this->container->get(RouterInterface::class);

        $centumRequestFactory = new RequestFactory();

        $centumRequest = $centumRequestFactory->createFromBrowserKitRequest($request);

        $centumResponse = $router->handle($centumRequest);

        return new BrowserKitResponse(
            $centumResponse->getContent(),
            $centumResponse->getStatus()->getCode(),
            $centumResponse->getHeaders()->toArray()
        );
    }
}
