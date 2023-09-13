<?php

namespace Centum\Container\Resolver;

use Centum\Container\Exception\CookieNotFoundException;
use Centum\Container\Exception\FileGroupNotFoundException;
use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ParameterInterface;
use Centum\Interfaces\Container\ResolverInterface;
use Centum\Interfaces\Http\CookieInterface;
use Centum\Interfaces\Http\CookiesInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FilesInterface;
use Centum\Interfaces\Http\HeadersInterface;
use Centum\Interfaces\Http\RequestInterface;

class RequestResolver implements ResolverInterface
{
    public function __construct(
        protected readonly RequestInterface $request
    ) {
    }



    /**
     * @throws UnresolvableParameterException
     * @throws CookieNotFoundException
     * @throws FileGroupNotFoundException
     */
    public function resolve(ParameterInterface $parameter): mixed
    {
        if (!$parameter->hasName()) {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$parameter->isObject()) {
            throw new UnresolvableParameterException($parameter);
        }

        $name = $parameter->getName();
        $type = $parameter->getType();

        if ($type === CookieInterface::class) {
            $cookies = $this->request->getCookies();

            if (!$cookies->has($name)) {
                if ($parameter->allowsNull()) {
                    return null;
                }

                throw new CookieNotFoundException($name);
            }

            return $cookies->get($name);
        }

        if ($type === FileGroupInterface::class) {
            $files = $this->request->getFiles();

            if (!$files->has($name)) {
                if ($parameter->allowsNull()) {
                    return null;
                }

                throw new FileGroupNotFoundException($name);
            }

            return $files->get($name);
        }

        return match ($type) {
            RequestInterface::class => $this->request,
            DataInterface::class    => $this->request->getData(),
            HeadersInterface::class => $this->request->getHeaders(),
            CookiesInterface::class => $this->request->getCookies(),
            FilesInterface::class   => $this->request->getFiles(),
            default                 => throw new UnresolvableParameterException($parameter),
        };
    }
}
