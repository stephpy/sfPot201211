<?php

namespace SfPot\Configuration;

use SfPot\Configuration\Loader\YamlDrinkLoader;
use SfPot\Configuration\Definition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Definition\Processor;


class Configuration
{
    public function load()
    {
        $paths            = array(__DIR__.'/../../../config');

        // loading food_dring yaml
        $locator          = new FileLocator($paths);
        $yamlLoader       = new YamlDrinkLoader($locator);
        $loaderResolver   = new LoaderResolver(array($yamlLoader));
        $delegatingLoader = new DelegatingLoader($loaderResolver);
        $config           = $delegatingLoader->load('food_drink.yml');

        $processor  = new Processor();
        $definition = new Definition();

        // validation of definition + normalization.
        return $processor->processConfiguration($definition, $config);
    }
}
