<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Tests;

use FrequenceWeb\Bundle\CalendRBundle\DependencyInjection\Compiler\EventProviderCompilerPass;
use FrequenceWeb\Bundle\CalendRBundle\FrequenceWebCalendRBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class FrequenceWebCalendRBundleTest extends TestCase
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
        $container = $this->getMockBuilder(ContainerBuilder::class)->setMethods(['addCompilerPass'])->getMock();

        $container
            ->expects($this->once())
            ->method('addCompilerPass')
            ->with($this->isInstanceOf(EventProviderCompilerPass::class));

        $this->object->build($container);
    }
}
