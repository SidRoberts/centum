<?php

namespace Centum\Http;

use Centum\Interfaces\Http\HeaderInterface;
use Centum\Interfaces\Http\HeadersInterface;
use OutOfRangeException;

class Headers implements HeadersInterface
{
    /**
     * @var array<non-empty-string, HeaderInterface>
     */
    protected array $headers = [];



    /**
     * @param array<HeaderInterface> $headers
     */
    public function __construct(array $headers = [])
    {
        $this->addMultiple($headers);
    }



    public function add(HeaderInterface $header): void
    {
        $name = $header->getName();

        $this->headers[$name] = $header;
    }

    public function addMultiple(array $headers): void
    {
        foreach ($headers as $header) {
            $this->add($header);
        }
    }



    /**
     * @throws OutOfRangeException
     */
    public function get(string $name): HeaderInterface
    {
        if (!isset($this->headers[$name])) {
            throw new OutOfRangeException();
        }

        return $this->headers[$name];
    }

    public function has(string $name): bool
    {
        return isset($this->headers[$name]);
    }

    /**
     * @throws OutOfRangeException
     */
    public function matches(string $name, string $value): bool
    {
        if (!$this->has($name)) {
            return false;
        }

        $header = $this->get($name);

        return $header->getValue() === $value;
    }



    public function send(): void
    {
        foreach ($this->headers as $header) {
            $header->send();
        }
    }



    public function all(): array
    {
        return $this->headers;
    }

    public function toArray(): array
    {
        $headers = [];

        foreach ($this->headers as $name => $header) {
            $headers[$name] = $header->getValue();
        }

        return $headers;
    }
}
