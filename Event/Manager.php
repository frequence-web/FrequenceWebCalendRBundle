<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Event;

use CalendR\Event\Manager as BaseManager;
use CalendR\Period\PeriodInterface;
use CalendR\Event\Provider\Aggregate;
use CalendR\Event\Provider\Cache;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Manager extends BaseManager
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $providers = array();
        foreach ($container->getParameter('frequence_web_calend_r.event_providers') as $provider) {
            $providers[] = $container->get($provider);
        }

        $this->setProvider(new Cache(new Aggregate($providers)));
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
