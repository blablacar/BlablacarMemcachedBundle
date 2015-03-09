<?php

namespace Blablacar\MemcachedBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('blablacar_memcached');

        $rootNode
            ->children()
                ->arrayNode('clients')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('persistent_id')->defaultValue(null)->end()
                            ->arrayNode('servers')
                                ->isRequired()
                                ->requiresAtLeastOneElement()
                                ->prototype('scalar')->defaultValue('127.0.0.1:11211')->cannotBeEmpty()->end()
                            ->end()
                            ->arrayNode('options')
                                ->prototype('scalar')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('session')
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('client')->isRequired()->end()
                        ->scalarNode('prefix')->defaultValue('session')->cannotBeEmpty()->end()
                        ->integerNode('ttl')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
