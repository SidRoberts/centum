<?php

namespace Centum\Router;

use Centum\Container\FormResolver;
use Centum\Container\RouterParametersResolver;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;
use Centum\Interfaces\Router\ExceptionHandlerInterface;
use Centum\Interfaces\Router\GroupInterface;
use Centum\Interfaces\Router\MiddlewareInterface;
use Centum\Interfaces\Router\ParametersInterface;
use Centum\Interfaces\Router\ReplacementInterface;
use Centum\Interfaces\Router\RouteInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Router\Exception\ParamNotFoundException;
use Centum\Router\Exception\ReplacementNotFoundException;
use Centum\Router\Exception\RouteMismatchException;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Exception\UnsuitableExceptionHandlerException;
use Centum\Router\Middleware\TrueMiddleware;
use Centum\Router\Replacements\AnyReplacement;
use Centum\Router\Replacements\CharacterReplacement;
use Centum\Router\Replacements\IntegerReplacement;
use Centum\Router\Replacements\SlugReplacement;
use Throwable;

class Router implements RouterInterface
{
    /** @var array<GroupInterface> */
    protected array $groups = [];

    /** @var array<string, ReplacementInterface> */
    protected array $replacements = [];

    /** @var array<class-string<ExceptionHandlerInterface>> */
    protected array $exceptionHandlers = [];



    public function __construct(
        protected readonly ContainerInterface $container
    ) {
        $container->set(RouterInterface::class, $this);

        $this->replacements = [
            "int"  => new IntegerReplacement(),
            "slug" => new SlugReplacement(),
            "char" => new CharacterReplacement(),
            "any"  => new AnyReplacement(),
        ];
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



    public function addReplacement(ReplacementInterface $replacement): void
    {
        $id = $replacement->getIdentifier();

        $this->replacements[$id] = $replacement;
    }



    /**
     * @param class-string<ExceptionHandlerInterface> $exceptionHandlerClass
     */
    public function addExceptionHandler(string $exceptionHandlerClass): void
    {
        $this->exceptionHandlers[] = $exceptionHandlerClass;
    }



    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            foreach ($this->groups as $group) {
                $middleware = $group->getMiddleware();

                if (!$middleware->check($request)) {
                    continue;
                }

                $routes = $group->getRoutes();

                foreach ($routes as $route) {
                    try {
                        return $this->matchRouteToRequest($request, $route);
                    } catch (RouteMismatchException) {
                        continue;
                    }
                }
            }

            throw new RouteNotFoundException($request);
        } catch (Throwable $throwable) {
            return $this->handleException($request, $throwable);
        }
    }



    protected function matchRouteToRequest(RequestInterface $request, RouteInterface $route): ResponseInterface
    {
        if ($request->getMethod() !== $route->getHttpMethod()) {
            throw new RouteMismatchException();
        }



        $uri = $request->getUri();
        $uri = "/" . trim($uri, "/");



        $pattern = preg_replace_callback(
            "/\{([A-Za-z]+)(\:([A-Za-z]+))?\}/",
            function (array $match): string {
                $key = $match[1];

                $replacementID = $match[3] ?? "any";

                $replacement = $this->replacements[$replacementID] ?? $this->replacements["any"];

                $regularExpression = $replacement->getRegularExpression();

                return "(?P<" . $key . ">" . $regularExpression . ")";
            },
            $route->getUri()
        );

        $pattern = "#^" . $pattern . "$#u";



        if (preg_match($pattern, $uri, $parameters) !== 1) {
            throw new RouteMismatchException();
        }

        $parameters = $this->removeIntegerKeys($parameters);



        $routeParameters = $route->getParameters();

        foreach ($routeParameters as $key => $replacementID) {
            $replacement = $this->replacements[$replacementID] ?? throw new ReplacementNotFoundException($replacementID);

            /** @var string */
            $value = $parameters[$key] ?? throw new ParamNotFoundException($key);

            /** @var mixed */
            $parameters[$key] = $replacement->filter($value);
        }



        $parameters = new Parameters($parameters);

        $this->container->set(ParametersInterface::class, $parameters);
        $this->container->set(RequestInterface::class, $request);

        $this->container->addResolver(
            new RouterParametersResolver($parameters)
        );

        $this->container->addResolver(
            new FormResolver($request)
        );

        $response = $this->executeRoute($route);

        return $response;
    }

    protected function executeRoute(RouteInterface $route): ResponseInterface
    {
        $class  = $route->getClass();
        $method = $route->getMethod();

        $controller = $this->container->get($class);

        /** @var ResponseInterface */
        return $this->container->typehintMethod($controller, $method);
    }



    protected function handleException(RequestInterface $request, Throwable $throwable): ResponseInterface
    {
        foreach ($this->exceptionHandlers as $exceptionHandlerClass) {
            $exceptionHandler = $this->container->get($exceptionHandlerClass);

            try {
                return $exceptionHandler->handle($request, $throwable);
            } catch (UnsuitableExceptionHandlerException) {
                continue;
            }
        }

        throw $throwable;
    }



    /**
     * @template T
     *
     * @param array<array-key, T> $array
     *
     * @return array<string, T>
     */
    protected function removeIntegerKeys(array $array): array
    {
        /** @var array<string, T> */
        return array_filter(
            $array,
            function (mixed $key): bool {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
