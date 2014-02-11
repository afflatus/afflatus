<?php
namespace Afflatus\Component\Router\Tests;

use Afflatus\Component\Router\GroupedStraightRoutingStrategy;

/**
 * GroupedStraightRoutingStrategyTest
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.10. 22:40
 */
class GroupedStraightRoutingStrategyTest extends StraightRoutingStrategyTest
{
    /**
     * @var GroupedStraightRoutingStrategy
     */
    protected $strategy;

    /**
     * Setting up
     */
    public function setUp()
    {
        $this->strategy = new GroupedStraightRoutingStrategy('namespace');
    }

    /**
     *
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Afflatus\Component\Router\GroupedStraightRoutingStrategy', $this->strategy);

        $property = new \ReflectionProperty(get_class($this->strategy), 'namespace');
        $property->setAccessible(true);
        $this->assertEquals('namespace', $property->getValue($this->strategy));
    }

    /**
     * @covers Afflatus\Component\Router\GroupedStraightRoutingStrategy::findDestination
     */
    public function testFindDestination()
    {
        $destination = $this->strategy->findDestination('/group/demo/index/param1/param2', 'GET');

        $this->assertEquals('namespace\Group\DemoController', $destination->getControllerClass());
        $this->assertEquals('index', $destination->getAction());
        $this->assertEquals(array('param1', 'param2'), $destination->getArguments());
    }

    /**
     * @covers Afflatus\Component\Router\GroupedStraightRoutingStrategy::findDestination
     */
    public function testFindDestinationNoNamespace()
    {
        $this->strategy->setNamespace('');
        $destination = $this->strategy->findDestination('/group/demo/index/param1/param2/', 'GET');

        $this->assertEquals('GroupDemoController', $destination->getControllerClass());
        $this->assertEquals('index', $destination->getAction());
        $this->assertEquals(array('param1', 'param2'), $destination->getArguments());
    }
}
