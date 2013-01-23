<?php

namespace FrequenceWeb\Bundle\CalendRBundle;

use FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\Compiler\EventProviderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FrequenceWebCalendRBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new EventProviderCompilerPass());
    }
}
