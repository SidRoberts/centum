<?php

namespace Centum\Router;

use Centum\Container\Container;
use Centum\Forms\Form;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Router\Exception\FormRequestException;
use Centum\Router\Exception\ParamNotFoundException;
use Centum\Router\Exception\RouteMismatchException;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Middleware\TrueMiddleware;
use Throwable;

class Router
{
    protected Container $container;

    /**
     * @var Group[]
     */
    protected array $groups = [];

    /**
     * @var array<class-string, array>
     */
    protected array $exceptionHandlers = [];



    public function __construct(Container $container)
    {
        $this->container = $container;
    }



    public function group(MiddlewareInterface $middleware = null): Group
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



    public function handle(Request $request): Response
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
                if (is_a($exception, $exceptionClass)) {
                    $this->container->set(get_class($exception), $exception);
                    $this->container->set($exceptionClass, $exception);
                    $this->container->set(Throwable::class, $exception);

                    $this->container->set(Request::class, $request);

                    /**
                     * @var class-string
                     */
                    $class = $path[0];

                    /**
                     * @var string
                     */
                    $method = $path[1];

                    return $this->executeMethod($class, $method);
                }
            }

            throw $exception;
        }
    }



    protected function matchRouteToRequest(Request $request, Route $route): Response
    {
        if ($request->getMethod() !== $route->getHttpMethod()) {
            throw new RouteMismatchException();
        }



        $uri     = $request->getUri();
        $pattern = $route->getUriPattern();

        if (preg_match($pattern, $uri, $params) !== 1) {
            throw new RouteMismatchException();
        }



        /**
         * Remove integer keys from params.
         *
         * @var array<string, mixed>
         */
        $params = array_filter(
            $params,
            function (string $key): bool {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_KEY
        );



        $filters = $route->getFilters();

        foreach ($filters as $key => $filter) {
            /**
             * @var string
             */
            $value = $params[$key] ?? throw new ParamNotFoundException();

            /**
             * @var mixed
             */
            $params[$key] = $filter->filter($value);
        }



        $form = $route->getForm();

        if ($form) {
            $status = $request->validate($form);

            if (!$status->isValid()) {
                throw new FormRequestException($status);
            }

            $this->container->set(Form::class, $form);
        }



        $params = new Parameters($params);

        $this->container->set(Parameters::class, $params);
        $this->container->set(Request::class, $request);

        $class  = $route->getClass();
        $method = $route->getMethod();

        return $this->executeMethod($class, $method);
    }

    /**
     * @param class-string $class
     */
    protected function executeMethod(string $class, string $method): Response
    {
        $controller = $this->container->typehintClass($class);

        /**
         * @var Response
         */
        return $this->container->typehintMethod($controller, $method);
    }
}