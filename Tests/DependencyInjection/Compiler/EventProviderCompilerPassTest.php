<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Tests\DependencyInjection\Compiler;

use FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\Compiler\EventProviderCompilerPass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class EventProviderCompilerPassTest extends TestCase
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
        $eventManager = $this->getMockBuilder(Definition::class)->setMethods(['addMethodCall'])->getMock();
        $container    = $this->getMockBuilder(ContainerBuilder::class)
                             ->setMethods(['getDefinition', 'findTaggedServiceIds'])
                             ->getMock();

        $container
            ->expects($this->once())
            ->method('getDefinition')
            ->with($this->equalTo('frequence_web_calendr.event.manager'))
            ->will($this->returnValue($eventManager));

        $container
            ->expects($this->once())
            ->method('findTaggedServiceIds')
            ->with($this->equalTo('calendr.event_provider'))
            ->will($this->returnValue(['provider1' => [['alias' => 'foo']], 'provider2' => null]));

        $eventManager
            ->expects($this->at(0))
            ->method('addMethodCall')
            ->with($this->equalTo('addProvider'), $this->equalTo(['foo', new Reference('provider1')]));

        $eventManager
            ->expects($this->at(1))
            ->method('addMethodCall')
            ->with($this->equalTo('addProvider'), $this->equalTo(['provider2', new Reference('provider2')]));

        $this->object->process($container);
    }
}
