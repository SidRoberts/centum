<?php

namespace Centum\Container;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\Terminal\ArgumentsInterface;
use Centum\Interfaces\Container\ResolverInterface;
use ReflectionNamedType;
use ReflectionParameter;

class ConsoleResolver implements ResolverInterface
{
    public function __construct(
        protected readonly ArgumentsInterface $arguments
    ) {
    }



    public function resolve(ReflectionParameter $parameter): mixed
    {
        $declaringClass = $parameter->getDeclaringClass();

        if ($declaringClass === null || !is_subclass_of($declaringClass->getName(), CommandInterface::class)) {
            throw new UnresolvableParameterException($parameter);
        }

        $type = $parameter->getType();

        if (!($type instanceof ReflectionNamedType)) {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$type->isBuiltIn()) {
            throw new UnresolvableParameterException($parameter);
        }

        /** @var non-empty-string */
        $name = $this->camelCaseToSlug(
            $parameter->getName()
        );

        if ($type->getName() === "bool") {
            return $this->arguments->hasParameter($name);
        }

        if ($type->getName() !== "string") {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$this->arguments->hasParameter($name)) {
            throw new UnresolvableParameterException($parameter);
        }

        return $this->arguments->getParameter($name);
    }

    protected function camelCaseToSlug(string $slug): string
    {
        return preg_replace_callback(
            "/([A-Z])/",
            function ($matches): string {
                return "-" . strtolower($matches[1]);
            },
            lcfirst($slug)
        );
    }
}
