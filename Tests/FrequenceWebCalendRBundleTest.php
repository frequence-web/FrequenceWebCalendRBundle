<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Tests;

use FrequenceWeb\Bundle\CalendRBundle\FrequenceWebCalendRBundle;

/**
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class FrequenceWebCalendRBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FrequenceWebCalendRBundle
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new FrequenceWebCalendRBundle;
    }

    public function testBuild()
    {
        $container = $this->getMock(
            'Symfony\Component\DependencyInjection\ContainerBuilder',
            array('addCompilerPass')
        );

        $container
            ->expects($this->once())
            ->method('addCompilerPass')
            ->with($this->isInstanceOf('FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\Compiler\EventProviderCompilerPass'));

        $this->object->build($container);
    }
}
