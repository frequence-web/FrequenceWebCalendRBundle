<?php

namespace FrequenceWeb\Bundle\CalendRBundle\DependencyInjection;

use CalendR\Event\Provider\ProviderInterface;
use FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\Compiler\EventProviderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FrequenceWebCalendRExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container
            ->getDefinition('frequence_web_calendr.factory')
            ->addMethodCall('setFirstWeekday', [$config['periods']['default_first_weekday']]);

        if (\method_exists($container, 'registerForAutoconfiguration')) {
            $container->registerForAutoconfiguration(ProviderInterface::class)
                      ->addTag(EventProviderCompilerPass::TAG);
        }
    }
}
