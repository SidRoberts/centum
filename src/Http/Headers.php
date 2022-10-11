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
        foreach ($headers as $header) {
            $this->add($header);
        }
    }



    public function add(HeaderInterface $header): void
    {
        $name = $header->getName();

        $this->headers[$name] = $header;
    }



    public function get(string $name): HeaderInterface
    {
        return $this->headers[$name] ?? throw new OutOfRangeException();
    }

    public function has(string $name): bool
    {
        return isset($this->headers[$name]);
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
