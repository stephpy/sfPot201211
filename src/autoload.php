<?php

require_once __DIR__.'/../vendor/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';
//require_once __DIR__.'/../vendor/symfony/class-loader/Symfony/Component/ClassLoader/ApcUniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Symfony\Component\ClassLoader\ApcUniversalClassLoader;

$loader = new UniversalClassLoader();

$vendorDir = __DIR__.'/../vendor';

$loader->registerNamespaces(array(
    'Symfony\\Component\\Yaml' => $vendorDir.'/symfony/yaml',
    'Symfony\\Component\\DependencyInjection' => $vendorDir.'/symfony/dependency-injection',
    'Symfony\\Component\\Console' => $vendorDir.'/symfony/console',
    'Symfony\\Component\\Config' => $vendorDir.'/symfony/config',
    'SfPot' => __DIR__,
));

// twig which has convention Twig_Xyz would use:
//$loader->registerPrefixes(array(
//    'Twig_'  => __DIR__.'/vendor/twig/lib',
//));

$loader->register();
