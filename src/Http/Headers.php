<?php

namespace Centum\Http;

use Centum\Interfaces\Http\HeaderInterface;
use Centum\Interfaces\Http\HeadersInterface;
use OutOfRangeException;

class Headers implements HeadersInterface
{
    /** @var array<string, HeaderInterface> */
    protected array $headers = [];



    /**
     * @param HeaderInterface[] $headers
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

    /**
     * @param HeaderInterface[] $headers
     */
    public function addMultiple(array $headers): void
    {
        foreach ($headers as $header) {
            $this->add($header);
        }
    }



    public function get(string $name): HeaderInterface
    {
        return $this->headers[$name] ?? throw new OutOfRangeException();
    }

    public function has(string $name): bool
    {
        return isset($this->headers[$name]);
    }

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



    /**
     * @return array<string, HeaderInterface>
     */
    public function all(): array
    {
        return $this->headers;
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        $headers = [];

        foreach ($this->headers as $name => $header) {
            $headers[$name] = $header->getValue();
        }

        return $headers;
    }
}
