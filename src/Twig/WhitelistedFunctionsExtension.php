<?php

namespace Centum\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WhitelistedFunctionsExtension extends AbstractExtension
{
    protected array $functionNames;



    public function __construct(array $functionNames)
    {
        $this->functionNames = $functionNames;
    }



    public function getFunctions() : array
    {
        $functions = [];

        foreach ($this->functionNames as $name) {
            $functions[] = new TwigFunction($name, $name);
        }

        return $functions;
    }

    public function getName() : string
    {
        return "whitelistedFunctions";
    }
}
