<?php

namespace Centum\Twig;

use Centum\Interfaces\Http\Csrf\StorageInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CsrfExtension extends AbstractExtension
{
    public function __construct(
        protected readonly StorageInterface $csrfStorage
    ) {
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
                [$this->csrfStorage, "get"],
                [
                    //TODO
                    "is_safe" => ["html"],
                ]
            ),
        ];
    }



    public function csrf(): string
    {
        $value = $this->csrfStorage->get();

        return sprintf(
            "<input type=\"hidden\" name=\"csrf\" value=\"%s\">",
            $value
        );
    }
}
