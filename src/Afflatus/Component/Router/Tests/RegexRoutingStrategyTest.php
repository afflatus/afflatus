<?php
namespace Afflatus\Component\Router\Tests;

use Afflatus\Component\Router\RegexRoutingStrategy;
use Afflatus\Component\Router\RegexRoutePatternInterface;

/**
 * RegexRoutingStrategyTest
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 21:42
 */
class RegexRoutingStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RegexRoutingStrategy
     */
    protected $strategy;

    /**
     * @var RegexRoutePatternInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $patternMock;

    /**
     * Setting up
     */
    public function setUp()
    {
        $this->patternMock = $this->getMock('Afflatus\Component\Router\RegexRoutePatternInterface');
        $this->strategy = new RegexRoutingStrategy(array($this->patternMock));
    }

    /**
     * @covers Afflatus\Component\Router\RegexRoutingStrategy::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Afflatus\Component\Router\RegexRoutingStrategy', $this->strategy);

        $property = new \ReflectionProperty(get_class($this->strategy), 'patterns');
        $property->setAccessible(true);

        $this->assertEquals(array($this->patternMock), $property->getValue($this->strategy));
    }

    /**
     * @covers Afflatus\Component\Router\RegexRoutingStrategy::addPattern
     */
    public function testAddPattern()
    {
        $secondPatterMock = $this->getMock('Afflatus\Component\Router\RegexRoutePatternInterface');

        $this->strategy->addPattern($secondPatterMock);

        $property = new \ReflectionProperty(get_class($this->strategy), 'patterns');
        $property->setAccessible(true);

        $this->assertEquals(array($this->patternMock, $secondPatterMock), $property->getValue($this->strategy));
    }

    /**
     * @covers Afflatus\Component\Router\RegexRoutingStrategy::findDestination
     */
    public function testFindDestinationNoMatch()
    {
        $requestUri = '/main/5';
        $requestMethod = 'GET';

        $this->patternMock->expects($this->once())
            ->method('getUriRegex')
            ->will($this->returnValue('^\/no_match\/(\w+)$'));

        $this->assertNull($this->strategy->findDestination($requestUri, $requestMethod));
    }

    /**
     * @covers Afflatus\Component\Router\RegexRoutingStrategy::findDestination
     */
    public function testFindDestinationDifferentRequestMethod()
    {
        $requestUri = '/main/5';
        $requestMethod = 'GET';

        $this->patternMock->expects($this->once())
            ->method('getUriRegex')
            ->will($this->returnValue('^\/main\/(\w+)$'));
        $this->patternMock->expects($this->once())
            ->method('matchRequestMethod')
            ->with($requestMethod)
            ->will($this->returnValue(false));

        $this->assertNull($this->strategy->findDestination($requestUri, $requestMethod));
    }

    /**
     * @covers Afflatus\Component\Router\RegexRoutingStrategy::findDestination
     */
    public function testFindDestinationLowerPriority()
    {
        $requestUri = '/main/5';
        $requestMethod = 'GET';

        $this->patternMock->expects($this->once())
            ->method('getUriRegex')
            ->will($this->returnValue('^\/main\/(\w+)$'));
        $this->patternMock->expects($this->once())
            ->method('matchRequestMethod')
            ->with($requestMethod)
            ->will($this->returnValue(true));
        $this->patternMock->expects($this->once())
            ->method('getPriority')
            ->will($this->returnValue(-1));

        $this->assertNull($this->strategy->findDestination($requestUri, $requestMethod));
    }

    /**
     * @covers Afflatus\Component\Router\RegexRoutingStrategy::findDestination
     */
    public function testFindDestination()
    {
        $requestUri = '/main/5';
        $requestMethod = 'GET';

        $this->patternMock->expects($this->once())
            ->method('getUriRegex')
            ->will($this->returnValue('^\/main\/(\w+)$'));
        $this->patternMock->expects($this->once())
            ->method('matchRequestMethod')
            ->with($requestMethod)
            ->will($this->returnValue(true));
        $this->patternMock->expects($this->exactly(2))
            ->method('getPriority')
            ->will($this->returnValue(1));
        $this->patternMock->expects($this->once())
            ->method('getControllerClass')
            ->will($this->returnValue(__NAMESPACE__ . '\TestController'));
        $this->patternMock->expects($this->once())
            ->method('getAction')
            ->will($this->returnValue('index'));

        $destination = $this->strategy->findDestination($requestUri, $requestMethod);

        $this->assertNotNull($destination);
        $this->assertInstanceOf('Afflatus\Component\Router\Destination', $destination);
        $this->assertEquals(__NAMESPACE__ . '\TestController', $destination->getControllerClass());
        $this->assertEquals('index', $destination->getAction());
        $this->assertEquals(array('5'), $destination->getArguments());
    }
}
