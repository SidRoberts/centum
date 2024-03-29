<?php

namespace Centum\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;

class JsonResponse extends Response
{
    public function __construct(mixed $variable, Status $status = Status::OK)
    {
        $content = json_encode(
            $variable,
            JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR
        );

        $headers = new Headers(
            [
                new Header("Content-Type", "application/json"),
            ]
        );

        parent::__construct($content, $status, $headers);
    }
}
