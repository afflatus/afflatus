<?php
namespace Afflatus\Component\Router\Tests;

use Afflatus\Component\Router\ControllerFactory;

/**
 * ControllerFactoryTest
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:24
 */
class ControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ControllerFactory
     */
    protected $factory;

    /**
     * Setting up
     */
    public function setUp()
    {
        $this->factory = new ControllerFactory();
    }

    /**
     *
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Afflatus\Component\Router\ControllerFactory', $this->factory);
    }

    /**
     * @covers Afflatus\Component\Router\ControllerFactory::create
     */
    public function testCreate()
    {
        $class = 'Afflatus\Component\Router\Tests\TestController';
        $this->assertInstanceOf($class, $this->factory->create($class));
    }
}
