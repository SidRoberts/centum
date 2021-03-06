<?php

namespace Centum\Twig;

use Centum\Flash\Flash;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FlashExtension extends AbstractExtension
{
    protected Flash $flash;



    public function __construct(Flash $flash)
    {
        $this->flash = $flash;
    }



    public function getFunctions() : array
    {
        return [
            new TwigFunction(
                "flash",
                function () : string {
                    return $this->flash->output();
                }
            ),
        ];
    }



    public function getName() : string
    {
        return "flash";
    }
}
