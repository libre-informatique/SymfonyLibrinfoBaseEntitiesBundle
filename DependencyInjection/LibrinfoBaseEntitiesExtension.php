<?php

namespace Librinfo\BaseEntitiesBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LibrinfoBaseEntitiesExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        // Loading KnpDoctrineBehaviors services
        try
        {
            $loader = new Loader\YamlFileLoader($container, new FileLocator($container->getParameter('kernel.root_dir') . "/../vendor/knplabs/doctrine-behaviors/config/"));
            $loader->load('orm-services.yml');
        }
        catch (\Exception $e)
        {

        }

    }
}
