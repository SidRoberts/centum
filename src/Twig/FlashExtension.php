<?php

namespace Centum\Twig;

use Centum\Interfaces\Flash\FlashInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FlashExtension extends AbstractExtension
{
    public function __construct(
        protected readonly FlashInterface $flash
    ) {
    }



    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                "flash",
                function (): string {
                    return $this->flash->output();
                },
                [
                    "is_safe" => ["html"],
                ]
            ),
        ];
    }
}
