<?php
namespace Afflatus\Component\Router\Tests;

use Afflatus\Component\Router\Router;

/**
 * RouterTest
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 23:18
 */
class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * Setting up
     */
    public function setUp()
    {
        $this->router = new Router();
    }

    /**
     *
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Afflatus\Component\Router\Router', $this->router);
    }

    /**
     * @covers Afflatus\Component\Router\Router::addStrategy
     */
    public function testAddStrategy()
    {
        $strategy = $this->getMock('Afflatus\Component\Router\RoutingStrategyInterface');
        $this->router->addStrategy($strategy);

        $property = new \ReflectionProperty(get_class($this->router), 'strategies');
        $property->setAccessible(true);

        $this->assertEquals(array($strategy), $property->getValue($this->router));
    }

    /**
     * @covers Afflatus\Component\Router\Router::findDestination
     */
    public function testFindDestination()
    {
        $requestUri = 'uri';
        $requestMethod = 'method';

        $strategy = $this->getMock('Afflatus\Component\Router\RoutingStrategyInterface');
        $strategy->expects($this->once())
            ->method('findDestination')
            ->with($requestUri, $requestMethod)
            ->will($this->returnValue(null));

        $this->router->addStrategy($strategy);

        $this->assertNull($this->router->findDestination($requestUri, $requestMethod));
    }

    /**
     * @covers Afflatus\Component\Router\Router::findDestination
     */
    public function testFindDestinationByFirstStrategy()
    {
        $requestUri = 'uri';
        $requestMethod = 'method';

        $destination = $this->getMockBuilder('Afflatus\Component\Router\Destination')
            ->disableOriginalConstructor()
            ->getMock();

        $strategy1 = $this->getMock('Afflatus\Component\Router\RoutingStrategyInterface');
        $strategy1->expects($this->once())
            ->method('findDestination')
            ->with($requestUri, $requestMethod)
            ->will($this->returnValue($destination));

        $strategy2 = $this->getMock('Afflatus\Component\Router\RoutingStrategyInterface');
        $strategy2->expects($this->exactly(0))
            ->method('findDestination');

        $this->router->addStrategy($strategy1);
        $this->router->addStrategy($strategy2);

        $this->assertEquals($destination, $this->router->findDestination($requestUri, $requestMethod));
    }
}
