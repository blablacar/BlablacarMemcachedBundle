<?php

namespace Blablacar\MemcachedBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class BlablacarMemcachedExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('memcached.xml');

        foreach ($config['clients'] as $name => $clientConfig) {
            $id = sprintf('blablacar_memcached.client.%s', $name);

            $baseClientDefinition = new DefinitionDecorator('blablacar_memcached.client.base');
            $baseClientDefinition
                ->replaceArgument(0, $clientConfig['persistent_id'])
                ->addMethodCall('addServers', array($clientConfig['servers']))
            ;

            $container->setDefinition($id, $baseClientDefinition);
        }
    }
}
