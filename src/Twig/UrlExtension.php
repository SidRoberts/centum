<?php

namespace Centum\Twig;

use Centum\Interfaces\Url\UrlInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UrlExtension extends AbstractExtension
{
    protected readonly UrlInterface $url;



    public function __construct(UrlInterface $url)
    {
        $this->url = $url;
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
