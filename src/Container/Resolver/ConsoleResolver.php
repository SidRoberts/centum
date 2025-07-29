<?php

namespace Centum\Container\Resolver;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\Terminal\ArgumentsInterface;
use Centum\Interfaces\Container\ParameterInterface;
use Centum\Interfaces\Container\ResolverInterface;
use RuntimeException;

class ConsoleResolver implements ResolverInterface
{
    public function __construct(
        protected readonly ArgumentsInterface $arguments
    ) {
    }



    /**
     * @throws RuntimeException
     * @throws UnresolvableParameterException
     */
    public function resolve(ParameterInterface $parameter): mixed
    {
        if (!$parameter->hasDeclaringClass() || !is_subclass_of($parameter->getDeclaringClass(), CommandInterface::class)) {
            throw new UnresolvableParameterException($parameter);
        }

        if ($parameter->isObject()) {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$parameter->hasName()) {
            throw new UnresolvableParameterException($parameter);
        }

        /** @var non-empty-string */
        $name = $this->camelCaseToSlug(
            $parameter->getName()
        );

        if ($parameter->getType() === "bool") {
            return $this->arguments->hasParameter($name);
        }

        if ($parameter->getType() !== "string") {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$this->arguments->hasParameter($name)) {
            throw new UnresolvableParameterException($parameter);
        }

        return $this->arguments->getParameter($name);
    }

    /**
     * @throws RuntimeException
     */
    protected function camelCaseToSlug(string $camelCase): string
    {
        $slug = preg_replace_callback(
            "/([A-Z])/",
            function ($matches): string {
                return "-" . mb_strtolower($matches[1]);
            },
            lcfirst($camelCase)
        );

        if ($slug === null) {
            throw new RuntimeException("Failed to convert camel-case to slug.");
        }

        return $slug;
    }
}
