<?php

namespace Centum\Router;

use Centum\Http\Response;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\GroupInterface;
use Centum\Interfaces\Router\MiddlewareInterface;
use Centum\Interfaces\Router\ParametersInterface;
use Centum\Interfaces\Router\ReplacementInterface;
use Centum\Interfaces\Router\RouteInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Router\Exception\ParamNotFoundException;
use Centum\Router\Exception\RouteMismatchException;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Middleware\TrueMiddleware;
use Centum\Router\Replacements\AnyReplacement;
use Centum\Router\Replacements\CharacterReplacement;
use Centum\Router\Replacements\IntegerReplacement;
use Centum\Router\Replacements\SlugReplacement;
use Exception;
use Throwable;

class Router implements RouterInterface
{
    protected readonly ContainerInterface $container;

    /** @var GroupInterface[] */
    protected array $groups = [];

    /** @var array<string, ReplacementInterface> */
    protected array $replacements = [];

    /** @var array<class-string, array{class-string, string}> */
    protected array $exceptionHandlers = [];



    public function __construct(ContainerInterface $container)
    {
        $container->set(RouterInterface::class, $this);

        $this->container = $container;

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
                    } catch (RouteMismatchException) {
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



        $uri = $request->getUri();
        $uri = "/" . trim($uri, "/");



        $replacements = $this->replacements;

        $pattern = preg_replace_callback(
            "/\{([A-Za-z]+)(\:([A-Za-z]+))?\}/",
            function (array $match) use ($replacements): string {
                $key = $match[1];

                $replacementID = $match[3] ?? "any";

                $replacement = $replacements[$replacementID] ?? $replacements["any"];

                $regularExpression = $replacement->getRegularExpression();

                return "(?P<" . $key . ">" . $regularExpression . ")";
            },
            $route->getUri()
        );

        $pattern = "#^" . $pattern . "$#u";



        if (preg_match($pattern, $uri, $parameters) !== 1) {
            throw new RouteMismatchException();
        }

        /** @var array<string, string> */
        $parameters = $this->removeIntegerKeys($parameters);



        $routeParameters = $route->getParameters();

        foreach ($routeParameters as $key => $replacementID) {
            $replacement = $replacements[$replacementID] ?? throw new Exception("Replacement class not found.");

            /** @var string */
            $value = $parameters[$key] ?? throw new ParamNotFoundException($key);

            /** @var mixed */
            $parameters[$key] = $replacement->filter($value);
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



    /**
     * @return array<array-key, mixed>
     */
    protected function removeIntegerKeys(array $array)
    {
        return array_filter(
            $array,
            function (mixed $key): bool {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
