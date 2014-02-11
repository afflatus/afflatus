<?php
namespace Afflatus\Component\Router\Tests;

use Afflatus\Component\Router\StraightRoutingStrategy;

/**
 * StraightRoutingStrategyTest
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.10. 22:40
 */
class StraightRoutingStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StraightRoutingStrategy
     */
    protected $strategy;

    /**
     * Setting up
     */
    public function setUp()
    {
        $this->strategy = new StraightRoutingStrategy('namespace');
    }

    /**
     * @covers Afflatus\Component\Router\StraightRoutingStrategy::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Afflatus\Component\Router\StraightRoutingStrategy', $this->strategy);

        $property = new \ReflectionProperty(get_class($this->strategy), 'namespace');
        $property->setAccessible(true);
        $this->assertEquals('namespace', $property->getValue($this->strategy));
    }

    /**
     * @covers Afflatus\Component\Router\StraightRoutingStrategy::getNamespace
     */
    public function testGetControllerClass()
    {
        $this->assertEquals('namespace', $this->strategy->getNamespace());
    }

    /**
     * @covers Afflatus\Component\Router\StraightRoutingStrategy::setNamespace
     */
    public function testGetAction()
    {
        $this->strategy->setNamespace('namespace2');
        $this->assertEquals('namespace2', $this->strategy->getNamespace());
    }

    /**
     * @covers Afflatus\Component\Router\StraightRoutingStrategy::findDestination
     */
    public function testFindDestination()
    {
        $destination = $this->strategy->findDestination('/demo/index/param1/param2', 'GET');

        $this->assertEquals('namespace\DemoController', $destination->getControllerClass());
        $this->assertEquals('index', $destination->getAction());
        $this->assertEquals(array('param1', 'param2'), $destination->getArguments());
    }

    /**
     * @covers Afflatus\Component\Router\StraightRoutingStrategy::findDestination
     */
    public function testFindDestinationNoNamespace()
    {
        $this->strategy->setNamespace('');
        $destination = $this->strategy->findDestination('/demo/index/param1/param2/', 'GET');

        $this->assertEquals('DemoController', $destination->getControllerClass());
        $this->assertEquals('index', $destination->getAction());
        $this->assertEquals(array('param1', 'param2'), $destination->getArguments());
    }
}
