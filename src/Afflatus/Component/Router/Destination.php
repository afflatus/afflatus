<?php
namespace Afflatus\Component\Router;

/**
 * Destination
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:14
 */
class Destination
{
    /**
     * @var string
     */
    protected $controllerClass;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var array
     */
    protected $arguments = array();

    /**
     * @param string $controllerClass
     * @param string $action
     * @param array $arguments
     */
    public function __construct($controllerClass, $action, array $arguments = array())
    {
        $this->controllerClass = $controllerClass;
        $this->action = $action;
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param ControllerFactoryInterface $factory
     * @return array
     */
    public function getCallable(ControllerFactoryInterface $factory)
    {
        return array(
            $factory->create($this->controllerClass),
            $this->action . 'Action'
        );
    }
}
