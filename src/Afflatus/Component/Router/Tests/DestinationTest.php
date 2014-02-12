<?php
namespace Afflatus\Component\Router\Tests;

use Afflatus\Component\Router\Destination;

/**
 * DestinationTest
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:29
 */
class DestinationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Destination
     */
    protected $destination;

    /**
     * Setting up
     */
    public function setUp()
    {
        $this->destination = new Destination(__NAMESPACE__ . '\TestController', 'index', array('argument1'));
    }

    /**
     * @covers Afflatus\Component\Router\Destination::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Afflatus\Component\Router\Destination', $this->destination);
    }

    /**
     * @covers Afflatus\Component\Router\Destination::getControllerClass
     */
    public function testGetControllerClass()
    {
        $this->assertEquals(__NAMESPACE__ . '\TestController', $this->destination->getControllerClass());
    }

    /**
     * @covers Afflatus\Component\Router\Destination::getAction
     */
    public function testGetAction()
    {
        $this->assertEquals('index', $this->destination->getAction());
    }

    /**
     * @covers Afflatus\Component\Router\Destination::getArguments
     */
    public function testGetArguments()
    {
        $this->assertEquals(array('argument1'), $this->destination->getArguments());
    }

    /**
     * @covers Afflatus\Component\Router\Destination::getCallable
     */
    public function testGetCallable()
    {
        $testController = new TestController();
        $factoryMock = $this->getMock('Afflatus\Component\Router\ControllerFactoryInterface');
        $factoryMock->expects($this->once())
            ->method('create')
            ->with($this->destination->getControllerClass())
            ->will($this->returnValue($testController));

        $this->assertEquals(
            array($testController, 'indexAction'),
            $this->destination->getCallable($factoryMock)
        );
    }
}
