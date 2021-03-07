<?php

namespace Centum\Config;

use ValueError;

class Factory
{
    public static function yaml(string $path) : Config
    {
        $data = yaml_parse_file($path);

        if (!is_array($data)) {
            throw new ValueError();
        }

        $config = new Config($data);

        return $config;
    }
}
