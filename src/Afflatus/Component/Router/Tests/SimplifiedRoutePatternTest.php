<?php
namespace Afflatus\Component\Router\Tests;

use Afflatus\Component\Router\SimplifiedRoutePattern;

/**
 * SimplifiedRoutePatternTest
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 21:29
 */
class SimplifiedRoutePatternTest extends RegexRoutePatternTest
{
    /**
     * @var SimplifiedRoutePattern
     */
    protected $pattern;

    /**
     * Setting up
     */
    public function setUp()
    {
        $this->pattern = new SimplifiedRoutePattern('/main/{param1}/sub/{param2}', 'class', 'index');
    }

    /**
     *
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Afflatus\Component\Router\SimplifiedRoutePattern', $this->pattern);
    }

    /**
     * @covers Afflatus\Component\Router\SimplifiedRoutePattern::getUriRegex
     */
    public function testGetUriRegex()
    {
        $this->assertEquals('^\/main\/(\w+)\/sub\/(\w+)$', $this->pattern->getUriRegex());
    }
}
