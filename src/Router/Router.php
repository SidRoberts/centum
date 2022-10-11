<?php

namespace Centum\Router;

use Centum\Http\Response;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\GroupInterface;
use Centum\Interfaces\Router\MiddlewareInterface;
use Centum\Interfaces\Router\ParametersInterface;
use Centum\Interfaces\Router\RouteInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Router\Exception\ParamNotFoundException;
use Centum\Router\Exception\RouteMismatchException;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Middleware\TrueMiddleware;
use Throwable;

class Router implements RouterInterface
{
    protected readonly ContainerInterface $container;

    /** @var GroupInterface[] */
    protected array $groups = [];

    /** @var array<class-string, array{class-string, string}> */
    protected array $exceptionHandlers = [];



    public function __construct(ContainerInterface $container)
    {
        $container->set(RouterInterface::class, $this);

        $this->container = $container;
    }



    public function group(MiddlewareInterface $middleware = null): GroupInterface
    {
        if (!$middleware) {
            $middleware = new TrueMiddleware();
        }

        $group = new Group($middleware);

        $this->groups[] = $group;

        return $group;
    }



    /**
     * @param class-string $exceptionClass
     * @param class-string $class
     */
    public function addExceptionHandler(string $exceptionClass, string $class, string $method): void
    {
        $this->exceptionHandlers[$exceptionClass] = [
            $class,
            $method,
        ];
    }



    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            foreach ($this->groups as $group) {
                $middleware = $group->getMiddleware();

                if (!$middleware->middleware($request, $this->container)) {
                    continue;
                }

                $routes = $group->getRoutes();

                foreach ($routes as $route) {
                    try {
                        return $this->matchRouteToRequest($request, $route);
                    } catch (RouteMismatchException $exception) {
                        continue;
                    }
                }
            }

            throw new RouteNotFoundException($request);
        } catch (Throwable $exception) {
            foreach ($this->exceptionHandlers as $exceptionClass => $path) {
                /** @psalm-suppress DocblockTypeContradiction */
                if (is_a($exception, $exceptionClass)) {
                    $this->container->set(get_class($exception), $exception);
                    $this->container->set($exceptionClass, $exception);
                    $this->container->set(Throwable::class, $exception);

                    $this->container->set(RequestInterface::class, $request);

                    $class  = $path[0];
                    $method = $path[1];

                    return $this->executeMethod($class, $method);
                }
            }

            throw $exception;
        }
    }



    protected function matchRouteToRequest(RequestInterface $request, RouteInterface $route): ResponseInterface
    {
        if ($request->getMethod() !== $route->getHttpMethod()) {
            throw new RouteMismatchException();
        }



        $uri     = $request->getUri();
        $pattern = $route->getUriPattern();

        $uri = "/" . trim($uri, "/");

        if (preg_match($pattern, $uri, $parameters) !== 1) {
            throw new RouteMismatchException();
        }



        /**
         * Remove integer keys from params.
         *
         * @var array<string, string>
         */
        $parameters = array_filter(
            $parameters,
            function (string|int $key): bool {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_KEY
        );



        $filters = $route->getFilters();

        foreach ($filters as $key => $filter) {
            /** @var string */
            $value = $parameters[$key] ?? throw new ParamNotFoundException($key);

            /** @var mixed */
            $parameters[$key] = $filter->filter($value);
        }



        $parameters = new Parameters($parameters);

        $this->container->set(ParametersInterface::class, $parameters);
        $this->container->set(RequestInterface::class, $request);

        $class  = $route->getClass();
        $method = $route->getMethod();

        $response = $this->executeMethod($class, $method);

        return $response;
    }

    /**
     * @param class-string $class
     */
    protected function executeMethod(string $class, string $method): ResponseInterface
    {
        $controller = $this->container->get($class);

        /** @var Response */
        return $this->container->typehintMethod($controller, $method);
    }
}
