<?php
namespace Afflatus\Component\Router\Tests;

use Afflatus\Component\Router\RegexRoutePattern;

/**
 * RoutePatternTest
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:38
 */
class RegexRoutePatternTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RegexRoutePattern
     */
    protected $pattern;

    /**
     * Setting up
     */
    public function setUp()
    {
        $this->pattern = new RegexRoutePattern('pattern', 'class', 'index');
    }

    /**
     * @covers Afflatus\Component\Router\RoutePattern::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Afflatus\Component\Router\RegexRoutePattern', $this->pattern);
    }

    /**
     * @covers Afflatus\Component\Router\RoutePattern::getUriRegex
     */
    public function testGetUriRegex()
    {
        $this->assertEquals('pattern', $this->pattern->getUriRegex());
    }

    /**
     * @covers Afflatus\Component\Router\RoutePattern::getControllerClass
     */
    public function testGetControllerClass()
    {
        $this->assertEquals('class', $this->pattern->getControllerClass());
    }

    /**
     * @covers Afflatus\Component\Router\RoutePattern::getAction
     */
    public function testGetAction()
    {
        $this->assertEquals('index', $this->pattern->getAction());
    }

    /**
     * @covers Afflatus\Component\Router\RoutePattern::getRequestMethod
     */
    public function testGetRequestMethod()
    {
        $this->assertNull($this->pattern->getRequestMethod());

        $pattern = new RegexRoutePattern('pattern', 'class', 'action', 'GET');

        $this->assertEquals('GET', $pattern->getRequestMethod());
    }

    /**
     * @covers Afflatus\Component\Router\RoutePattern::getPriority
     */
    public function testGetPriority()
    {
        $this->assertEquals(1, $this->pattern->getPriority());

        $pattern = new RegexRoutePattern('pattern', 'class', 'action', 'GET', 10);

        $this->assertEquals(10, $pattern->getPriority());
    }

    /**
     * @covers Afflatus\Component\Router\RoutePattern::matchRequestMethod
     */
    public function testMatchRequestMethod()
    {
        $this->assertTrue($this->pattern->matchRequestMethod('GET'));
        $this->assertTrue($this->pattern->matchRequestMethod('POST'));

        $pattern = new RegexRoutePattern('pattern', 'class', 'action', 'GET');

        $this->assertTrue($pattern->matchRequestMethod('GET'));
        $this->assertFalse($pattern->matchRequestMethod('POST'));
    }
}
