<?php

namespace Centum\Http;

class Headers
{
    /**
     * @var array<string, Header>
     */
    protected array $headers = [];



    public function __construct(array $headers = [])
    {
        foreach ($headers as $header) {
            $this->add($header);
        }
    }



    public function add(Header $header) : void
    {
        $name = $header->getName();

        $this->headers[$name] = $header;
    }



    public function all() : array
    {
        return $this->headers;
    }

    public function toArray() : array
    {
        $headers = [];

        foreach ($this->headers as $name => $header) {
            $headers[$name] = $header->getValue();
        }

        return $headers;
    }
}
