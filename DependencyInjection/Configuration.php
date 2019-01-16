<?php

namespace FrequenceWeb\Bundle\CalendRBundle\DependencyInjection;

use CalendR\Period\Day;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder('frequence_web_calend_r');
        $root = method_exists($builder, 'getRootNode') ? $builder->getRootNode() : $builder->root('frequence_web_calend_r');

        $root
            ->children()
                ->arrayNode('periods')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default_first_weekday')
                            ->defaultValue(Day::MONDAY)
                            ->validate()
                                ->ifNotInArray(range(DAY::SUNDAY, DAY::SATURDAY))
                                ->thenInvalid('Day must be be between 0 (Sunday) and 6 (Saturday)')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}
