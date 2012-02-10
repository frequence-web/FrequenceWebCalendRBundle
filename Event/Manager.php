<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Event;

use CalendR\Event\Manager as BaseManager;
use CalendR\Event\Provider\ProviderInterface;
use CalendR\Event\Provider\Aggregate;
use CalendR\Event\Provider\Cache;

class Manager extends BaseManager
{
    /**
     * Allows to add a provider to the stack.
     *
     * @param \CalendR\Event\Provider\ProviderInterface $provider
     * @return Manager
     */
    public function addProvider(ProviderInterface $provider)
    {
        if (null === $this->provider) {
            $this->provider = new Cache(new Aggregate(array($provider)));
        } else if ($this->provider instanceof Cache && $this->provider->getProvider() instanceof Aggregate) {
            $this->provider->getProvider()->add($provider);
        } else if ($this->provider instanceof Aggregate) {
            $this->provider->add($provider);
        } else {
            $this->provider = new Cache(new Aggregate(array($this->provider, $provider)));
        }

        return $this;
    }
}