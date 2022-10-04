<?php

namespace Centum\Codeception\Actions;

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



    public function grabRouter(): RouterInterface
    {
        $container = $this->grabContainer();

        return $container->get(RouterInterface::class);
    }

    public function makeRouterGroup(MiddlewareInterface $middleware = null): GroupInterface
    {
        $router = $this->grabRouter();

        return $router->group($middleware);
    }



    public function startFollowingRedirects(): void
    {
        $this->followRedirects = true;
    }

    public function stopFollowingRedirects(): void
    {
        $this->followRedirects = false;
    }



    public function seeRouteExists(RequestInterface $request, string $message = ""): void
    {
        $router = $this->grabRouter();

        try {
            $router->handle($request);
        } catch (RouteNotFoundException $e) {
            Assert::fail($message);
        }
    }

    public function seeRouteNotFound(RequestInterface $request, string $message = ""): void
    {
        $router = $this->grabRouter();

        try {
            $router->handle($request);
        } catch (RouteNotFoundException $e) {
            return;
        }

        Assert::fail($message);
    }



    public function amOnPage(string $uri): void
    {
        $request = new Request($uri);

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

        $request = new Request(
            $this->response->getHeaders()->get("Location")->getValue()
        );

        return $this->handleRequest($request);
    }



    public function seeCurrentUrlEquals(string $url): void
    {
        if (!$this->response) {
            throw new ModuleException($this, "Page not loaded.");
        }

        Assert::assertEquals(
            $this->currentURI,
            $url
        );
    }

    public function grabResponseContent(): string
    {
        if (!$this->response) {
            throw new ModuleException($this, "Page not loaded.");
        }

        return $this->response->getContent();
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



    public function grabResponseCode(): int
    {
        if (!$this->response) {
            throw new ModuleException($this, "Page not loaded.");
        }

        return $this->response->getStatus()->getCode();
    }

    public function seeResponseCodeIs(int $expected, string $message = ""): void
    {
        $responseCode = $this->grabResponseCode();

        Assert::assertSame(
            $expected,
            $responseCode,
            $message
        );
    }

    public function seeResponseCodeIsNot(int $expected, string $message = ""): void
    {
        $responseCode = $this->grabResponseCode();

        Assert::assertNotSame(
            $expected,
            $responseCode,
            $message
        );
    }

    public function seeResponseCodeIsSuccessful(string $message = ""): void
    {
        $responseCode = $this->grabResponseCode();

        Assert::assertMatchesRegularExpression(
            "/^2\d{2}$/",
            $responseCode,
            $message
        );
    }

    public function seeResponseCodeIsServerError(string $message = ""): void
    {
        $responseCode = $this->grabResponseCode();

        Assert::assertMatchesRegularExpression(
            "/^5\d{2}$/",
            $responseCode,
            $message
        );
    }

    public function seePageNotFound(string $message = ""): void
    {
        $this->seeResponseCodeIs(404, $message);
    }
}
