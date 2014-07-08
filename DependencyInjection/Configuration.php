<?php

namespace Blablacar\MemcachedBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration
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
                                ->children()
                                    ->prototype('scalar')->defaultValue('127.0.0.1')->cannotBeEmpty()->end()
                                    ->prototype('integer')->defaultValue(11211)->cannotBeEmpty()->end()
                                    ->prototype('integer')->defaultValue(null)->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->booleanNode('enable_logger')->defaultTrue()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
