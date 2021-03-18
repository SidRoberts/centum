<?php

namespace Centum\Config;

class Config
{
    /**
     * @var array<string, mixed>
     */
    protected array $data;



    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                continue;
            }

            $data[$key] = new Config($value);
        }

        $this->data = $data;
    }



    public function toArray() : array
    {
        $data = $this->data;

        foreach ($data as $key => $value) {
            if (!($value instanceof Config)) {
                continue;
            }

            $data[$key] = $value->toArray();
        }

        return $data;
    }



    public function __get(string $name) : mixed
    {
        return $this->data[$name];
    }

    public function __set(string $name, mixed $value) : void
    {
        if (is_array($value)) {
            $value = new Config($value);
        }

        $this->data[$name] = $value;
    }

    public function __isset(string $name) : bool
    {
        return isset($this->data[$name]);
    }

    public function __unset(string $name) : void
    {
        unset($this->data[$name]);
    }
}
