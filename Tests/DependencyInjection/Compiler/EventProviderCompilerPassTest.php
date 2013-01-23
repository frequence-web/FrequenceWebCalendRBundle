<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Tests\DependencyInjection\Compiler;

use FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\Compiler\EventProviderCompilerPass;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class EventProviderCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventProviderCompilerPass
     */
    protected $object;

    public function setUp()
    {
        $this->object = new EventProviderCompilerPass;
    }

    public function testProcess()
    {
        $container = $this->getMock(
            'Symfony\Component\DependencyInjection\ContainerBuilder',
            array('getDefinition', 'findTaggedServiceIds')
        );

        $eventManager = $this->getMock('Symfony\Component\DependencyInjection\Definition');

        $container
            ->expects($this->once())
            ->method('getDefinition')
            ->with($this->equalTo('frequence_web_calendr.event.manager'))
            ->will($this->returnValue($eventManager));

        $container
            ->expects($this->once())
            ->method('findTaggedServiceIds')
            ->with($this->equalTo('calendr.event_provider'))
            ->will($this->returnValue(array('provider1' => array(array('alias' => 'foo')), 'provider2' => null)));

        $eventManager
            ->expects($this->at(0))
            ->method('addMethodCall')
            ->with($this->equalTo('addProvider'), $this->equalTo(array('foo', new Reference('provider1'))));

        $eventManager
            ->expects($this->at(1))
            ->method('addMethodCall')
            ->with($this->equalTo('addProvider'), $this->equalTo(array('provider2', new Reference('provider2'))));

        $this->object->process($container);
    }
}
