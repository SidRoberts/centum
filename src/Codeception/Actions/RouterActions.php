<?php

namespace Centum\Codeception\Actions;

use Centum\Http\Data;
use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\GroupInterface;
use Centum\Interfaces\Router\MiddlewareInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Router\Exception\RouteNotFoundException;
use Codeception\Exception\ModuleException;
use PHPUnit\Framework\Assert;

trait RouterActions
{
    abstract public function grabContainer(): ContainerInterface;



    protected ?string $currentURI = null;

    protected ?ResponseInterface $response = null;

    protected bool $followRedirects = true;



    /**
     * Grab the Router from the Container.
     */
    public function grabRouter(): RouterInterface
    {
        $container = $this->grabContainer();

        return $container->get(RouterInterface::class);
    }

    /**
     * Make a new group of Routes with an optional middleware.
     */
    public function makeRouterGroup(MiddlewareInterface $middleware = null): GroupInterface
    {
        $router = $this->grabRouter();

        return $router->group($middleware);
    }

    /**
     * Add an Exception Handler to the Router.
     *
     * @param class-string $exceptionHandlerClass
     */
    public function addRouterExceptionHandler(string $exceptionHandlerClass): void
    {
        $router = $this->grabRouter();

        $router->addExceptionHandler($exceptionHandlerClass);
    }



    public function startFollowingRedirects(): void
    {
        $this->followRedirects = true;
    }

    public function stopFollowingRedirects(): void
    {
        $this->followRedirects = false;
    }



    public function seeRouteExists(RequestInterface $request): void
    {
        $router = $this->grabRouter();

        try {
            $router->handle($request);
        } catch (RouteNotFoundException) {
            Assert::fail();
        }
    }

    public function seeRouteNotFound(RequestInterface $request): void
    {
        $router = $this->grabRouter();

        try {
            $router->handle($request);
        } catch (RouteNotFoundException) {
            return;
        }

        Assert::fail();
    }



    /**
     * @param array<string, mixed> $params
     */
    public function amOnPage(string $uri, array $params = []): void
    {
        $data = new Data($params);

        $request = new Request($uri, "GET", $data);

        $this->handleRequest($request);
    }

    public function handleRequest(RequestInterface $request): ResponseInterface
    {
        $router = $this->grabRouter();

        $this->currentURI = $request->getUri();

        $this->response = $router->handle($request);

        if ($this->response->getStatus()->isRedirect() && $this->followRedirects) {
            return $this->followRedirect();
        }

        return $this->response;
    }

    public function followRedirect(): ResponseInterface
    {
        if (!$this->response) {
            throw new ModuleException($this, "Page not loaded.");
        }

        $locationHeader = $this->response->getHeaders()->get("Location");

        $request = new Request(
            $locationHeader->getValue()
        );

        return $this->handleRequest($request);
    }



    public function grabCurrentUri(): string
    {
        if (!$this->currentURI) {
            throw new ModuleException($this, "Page not loaded.");
        }

        return $this->currentURI;
    }

    public function seeCurrentUriEquals(string $expectedUri): void
    {
        $currentUri = $this->grabCurrentUri();

        Assert::assertEquals(
            $expectedUri,
            $currentUri
        );
    }

    /**
     * Grab the Response last created.
     */
    public function grabResponse(): ResponseInterface
    {
        if (!$this->response) {
            throw new ModuleException($this, "Page not loaded.");
        }

        return $this->response;
    }

    /**
     * Grab the content from the Response last created.
     */
    public function grabResponseContent(): string
    {
        $response = $this->grabResponse();

        return $response->getContent();
    }



    public function seeResponseContentEquals(string $expected): void
    {
        $content = $this->grabResponseContent();

        Assert::assertEquals(
            $expected,
            $content
        );
    }

    public function seeResponseContentContains(string $expected): void
    {
        $content = $this->grabResponseContent();

        Assert::assertStringContainsString(
            $expected,
            $content
        );
    }



    /**
     * Grab the HTTP response code from the Response last created.
     */
    public function grabResponseCode(): int
    {
        $response = $this->grabResponse();

        $status = $response->getStatus();

        return $status->getCode();
    }

    /**
     * See if the HTTP response code is an expected value.
     */
    public function seeResponseCodeIs(int $expected): void
    {
        $responseCode = $this->grabResponseCode();

        Assert::assertSame(
            $expected,
            $responseCode
        );
    }

    /**
     * See if the HTTP response code is NOT an expected value.
     */
    public function seeResponseCodeIsNot(int $expected): void
    {
        $responseCode = $this->grabResponseCode();

        Assert::assertNotSame(
            $expected,
            $responseCode
        );
    }

    /**
     * See if the HTTP response code is 2xx.
     */
    public function seeResponseCodeIsSuccessful(): void
    {
        $responseCode = $this->grabResponseCode();

        Assert::assertMatchesRegularExpression(
            "/^2\d{2}$/",
            (string) $responseCode
        );
    }

    /**
     * See if the HTTP response code is 5xx.
     */
    public function seeResponseCodeIsServerError(): void
    {
        $responseCode = $this->grabResponseCode();

        Assert::assertMatchesRegularExpression(
            "/^5\d{2}$/",
            (string) $responseCode
        );
    }

    /**
     * See if the HTTP response code is 404.
     */
    public function seePageNotFound(): void
    {
        $this->seeResponseCodeIs(404);
    }
}
