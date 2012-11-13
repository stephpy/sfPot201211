<?php

namespace SfPot;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


/**
 * Kernel
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Kernel
{
    /**
     * boot
     */
    public function boot()
    {
        $configuration = new Configuration\Configuration();
        $config        = $configuration->load();

        $container     = new ContainerBuilder();
        $container->setParameter('app_path', __DIR__.'/../..');

        $container->setParameter('sfpot.food', $config['food']);
        $container->setParameter('sfpot.recipients', $config['recipient']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yml');

        // we want to inject food and drink on event_alert
        $definition = $container->getDefinition('event_alert');

        foreach ($config['drink'] as $key => $values) {
            $definition->addMethodCall('addDrink', array(
                Event\Drink::create($key, $values['type'], $values['quantity'])
            ));
        }

        $container->compile();

        return $container;
    }
}
