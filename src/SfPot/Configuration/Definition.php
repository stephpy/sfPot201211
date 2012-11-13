<?php

namespace SfPot\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Definition implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $tb = new TreeBuilder();
        $tb->root('sfpot')
            ->children()
                ->arrayNode('recipient')
                    ->requiresAtLeastOneElement()
                    ->prototype('scalar')
                    ->end()
                ->end()
                // FOOD
                ->arrayNode('food')
                    ->validate()
                        ->ifTrue(function ($v) {
                            return !in_array('olives', $v);
                        })
                        ->thenInvalid('Oh jeune, comment on fait sans les olives ?')
                    ->end()
                    ->prototype('scalar')
                    ->end()
                ->end()
                // DRINK
                ->arrayNode('drink')
                    ->prototype('array')
                        ->beforeNormalization()
                            ->ifTrue(function ($v) { return is_int($v); })
                            ->then(function($v) {
                                return array('type' => 'bouteille', 'quantity' => (int) $v);
                            })
                        ->end()
                        ->children()
                            ->scalarNode('type')->isRequired()->end()
                            ->scalarNode('quantity')->defaultValue(0)->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $tb;
    }
}
