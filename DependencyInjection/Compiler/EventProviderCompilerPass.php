<?php

namespace FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class EventProviderCompilerPass implements CompilerPassInterface
{
    /**
     * Process the services tagged with "calendr.event_provider" to add
     * them to the calendR event handling
     *
     * @param ContainerBuilder $container
     *
     * @return void
     *
     * @api
     */
    function process(ContainerBuilder $container)
    {
        $eventManager = $container->getDefinition('frequence_web_calendr.event.manager');

        foreach ($container->findTaggedServiceIds('calendr.event_provider') as $id => $attributes) {
            $providerAlias = isset($attributes[0]) && isset($attributes[0]['alias']) ? $attributes[0]['alias'] : $id;
            $eventManager->addMethodCall('addProvider', array($providerAlias, new Reference($id)));
        }
    }
}
