<?php

namespace Centum\Url\Twig;

use Centum\Url\Url;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UrlExtension extends AbstractExtension
{
    protected Url $url;



    public function __construct(Url $url)
    {
        $this->url = $url;
    }



    public function getFunctions()
    {
        return [
            new TwigFunction(
                "url",
                [
                    $this->url,
                    "get",
                ]
            )
        ];
    }

    public function getName()
    {
        return "url";
    }
}
