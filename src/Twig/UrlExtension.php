<?php

namespace Centum\Twig;

use Centum\Interfaces\Url\UrlInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UrlExtension extends AbstractExtension
{
    public function __construct(
        protected readonly UrlInterface $url
    ) {
    }



    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                "url",
                [
                    $this->url,
                    "get",
                ]
            ),
        ];
    }
}
