<?php

namespace Centum\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;

class JsonResponse extends Response
{
    public function __construct(mixed $variable)
    {
        $content = json_encode(
            $variable,
            JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR
        );

        $headers = new Headers();

        $headers->add(
            new Header("Content-Type", "application/json")
        );

        parent::__construct($content, Status::OK, $headers);
    }
}
