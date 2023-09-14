<?php

namespace Centum\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use InvalidArgumentException;

class RedirectResponse extends Response
{
    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        protected readonly string $targetUrl,
        Status $status = Status::FOUND
    ) {
        if ($targetUrl === "") {
            throw new InvalidArgumentException("URL can't be empty.");
        }

        $content = sprintf('<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0; url=%1$s" />

        <title>Redirecting to %1$s</title>
    </head>
    <body>
        Redirecting to <a href="%1$s">%1$s</a>.
    </body>
</html>', htmlspecialchars($targetUrl, \ENT_QUOTES, "UTF-8"));

        $headers = new Headers(
            [
                new Header("Content-Type", "text/html"),
                new Header("Location", $targetUrl),
            ]
        );

        if (!$status->isRedirect()) {
            throw new InvalidArgumentException(
                sprintf(
                    "The HTTP status code must be a 3xx redirect code ('%d' given).",
                    $status->getCode()
                )
            );
        }



        parent::__construct($content, $status, $headers);
    }



    public function getTargetUrl(): string
    {
        return $this->targetUrl;
    }
}
