<?php

namespace Centum\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;

class VariableResponse extends Response
{
    public function __construct(mixed $variable)
    {
        $content = var_export($variable, true);

        $headers = new Headers();

        $headers->add(
            new Header("Content-Type", "text/plain")
        );

        parent::__construct($content, Status::OK, $headers);
    }
}
