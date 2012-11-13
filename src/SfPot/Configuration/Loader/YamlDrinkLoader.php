<?php

namespace SfPot\Configuration\Loader;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class YamlDrinkLoader extends FileLoader
{
    public function load($resource, $type = null)
    {
        $path   = $this->locator->locate($resource);

        return Yaml::parse($path);
    }

    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}
