<?php

namespace Centum\Twig;

use Centum\Http\Csrf;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CsrfExtension extends AbstractExtension
{
    protected readonly Csrf $csrf;



    public function __construct(Csrf $csrf)
    {
        $this->csrf = $csrf;
    }



    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                "csrf",
                [$this, "csrf"],
                [
                    "is_safe" => ["html"],
                ]
            ),
            new TwigFunction(
                "csrfValue",
                [$this->csrf, "get"],
                [
                    //TODO
                    "is_safe" => ["html"],
                ]
            ),
        ];
    }



    public function csrf(): string
    {
        $csrf = $this->csrf->get();

        return sprintf(
            "<input type=\"hidden\" name=\"csrf\" value=\"%s\">",
            $csrf
        );
    }
}
