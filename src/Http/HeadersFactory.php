<?php

namespace Centum\Http;

class HeadersFactory
{
    public static function createFromGlobal(): Headers
    {
        $headers = new Headers();

        /**
         * @var string $name
         * @var string $value
         */
        foreach (getallheaders() as $name => $value) {
            $header = new Header($name, $value);

            $headers->add($header);
        }

        return $headers;
    }
}
