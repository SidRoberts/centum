<?php

namespace Centum\Config;

use ValueError;

class Factory
{
    public static function yaml(string $path) : Config
    {
        $data = yaml_parse_file($path);

        $config = new Config($data);

        return $config;
    }
}
