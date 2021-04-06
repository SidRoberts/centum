<?php

namespace Centum\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use InvalidArgumentException;

class RedirectResponse extends Response
{
    protected string $targetUrl;



    public function __construct(string $url, int $status = 302, Headers $headers = null)
    {
        if ($url === "") {
            throw new InvalidArgumentException("URL can't be empty.");
        }

        $this->targetUrl = $url;

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
</html>', htmlspecialchars($url, \ENT_QUOTES, "UTF-8"));

        if ($headers === null) {
            $headers = new Headers();
        }

        $headers->add(
            new Header("Content-Type", "text/html")
        );

        $headers->add(
            new Header("Location", $url)
        );

        if ($status < 300 || $status >= 400) {
            throw new InvalidArgumentException(
                sprintf(
                    "The HTTP status code must be a 3xx redirect code ('%s' given).",
                    $status
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