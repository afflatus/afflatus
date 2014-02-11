<?php
namespace Afflatus\Component\Router;

/**
 * RegexRoutePattern
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:03
 */
class RegexRoutePattern implements RegexRoutePatternInterface
{
    /**
     * @var string
     */
    protected $uriRegex;

    /**
     * @var string
     */
    protected $controllerClass;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $requestMethod;

    /**
     * @var int
     */
    protected $priority;

    /**
     * @param string $uriRegex
     * @param string $controllerClass
     * @param string $action
     * @param string $requestMethod
     * @param int $priority
     */
    public function __construct($uriRegex, $controllerClass, $action, $requestMethod = null, $priority = 1)
    {
        $this->uriRegex = $uriRegex;
        $this->controllerClass = $controllerClass;
        $this->action = $action;
        $this->requestMethod = $requestMethod;
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getUriRegex()
    {
        return $this->uriRegex;
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
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $requestMethod
     * @return bool
     */
    public function matchRequestMethod($requestMethod)
    {
        return is_null($this->requestMethod)
            || $this->requestMethod === $requestMethod;
    }
}
