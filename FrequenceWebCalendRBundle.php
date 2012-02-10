<?php

namespace FrequenceWeb\Bundle\CalendRBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\Compiler\EventProviderCompilerPass;

class FrequenceWebCalendRBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new EventProviderCompilerPass());
    }
}
