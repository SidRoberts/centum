<?php

namespace Centum\Tests\Container\Services;

use Centum\Container\Service;

class TypeHintedResolverService extends Service
{
    public function getName() : string
    {
        return "typeHintedResolver";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(string $parameter)
    {
        return sprintf(
            "The 'parameter' service says: %s",
            $parameter
        );
    }
}
