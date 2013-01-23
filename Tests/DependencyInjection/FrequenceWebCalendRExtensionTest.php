<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Tests\DependencyInjection;

use FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\FrequenceWebCalendRExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class FrequenceWebCalendRExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FrequenceWebCalendRExtension
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new FrequenceWebCalendRExtension;
    }

    public function testLoad()
    {
        $container = new ContainerBuilder;
        $this->object->load(array(), $container);

        $this->assertTrue($container->hasDefinition('frequence_web_calendr.event.manager'));
        $this->assertTrue($container->hasDefinition('frequence_web_calendr.factory'));
        $this->assertTrue($container->hasDefinition('frequence_web_calendr.twig_extension'));
        $this->assertTrue($container->hasAlias('calendr'));

        $this->assertTrue(
            $container->getDefinition('frequence_web_calendr.factory')->hasMethodCall('setEventManager')
        );
    }
}
