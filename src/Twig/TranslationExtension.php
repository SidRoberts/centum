<?php

namespace Centum\Twig;

use Centum\Interfaces\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TranslationExtension extends AbstractExtension
{
    public function __construct(
        protected readonly TranslatorInterface $translator
    ) {
    }



    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                "translate",
                [
                    $this->translator,
                    "translate",
                ],
                [
                    "is_safe" => ["html"],
                ]
            ),
        ];
    }
}
