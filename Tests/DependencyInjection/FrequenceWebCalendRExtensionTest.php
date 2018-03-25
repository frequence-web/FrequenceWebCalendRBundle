<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Tests\DependencyInjection;

use CalendR\Period\Day;
use FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\FrequenceWebCalendRExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class FrequenceWebCalendRExtensionTest extends TestCase
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
        $this->object->load([], $container);

        $this->assertTrue($container->hasDefinition('frequence_web_calendr.event.manager'));
        $this->assertTrue($container->hasDefinition('frequence_web_calendr.factory'));
        $this->assertTrue($container->hasDefinition('frequence_web_calendr.twig_extension'));
        $this->assertTrue($container->hasAlias('calendr'));

        $factory = $container->getDefinition('frequence_web_calendr.factory');
        $this->assertTrue($factory->hasMethodCall('setEventManager'));
        $this->assertTrue($factory->hasMethodCall('setFirstWeekday'));

        foreach ($factory->getMethodCalls() as $call) {
            if ('setFirstWeekday' === $call[0]) {
                $this->assertSame(Day::MONDAY, $call[1][0]);
            }
        }
    }
}
