<?php

namespace Centum\Http;

use InvalidArgumentException;

class RedirectResponse extends Response
{
    protected string $targetUrl;



    public function __construct(string $url, int $status = 302, array $headers = [])
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

        $headers[] = new Header("Content-Type", "text/html");

        $headers[] = new Header("Location", $url);

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
