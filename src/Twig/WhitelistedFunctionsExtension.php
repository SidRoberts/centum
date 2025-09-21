<?php

namespace Centum\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WhitelistedFunctionsExtension extends AbstractExtension
{
    /**
     * @param list<callable-string> $functionNames
     */
    public function __construct(
        protected readonly array $functionNames
    ) {
    }



    public function getFunctions(): array
    {
        $functions = [];

        foreach ($this->functionNames as $name) {
            $functions[] = new TwigFunction($name, $name);
        }

        return $functions;
    }
}
