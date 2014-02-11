<?php
namespace Afflatus\Component\Router;

/**
 * StraightRoutingStrategy
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.10. 22:39
 */
class StraightRoutingStrategy implements RoutingStrategyInterface
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $regex = '/^\/([a-z]+)\/([a-z]+)([\w\/]+)?$/';

    /**
     * @param string $namespace
     */
    public function __construct($namespace = '')
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @param string $requestUri
     * @param string $requestMethod
     * @return Destination
     */
    public function findDestination($requestUri, $requestMethod)
    {
        if (preg_match($this->regex, $requestUri, $match)) {
            return $this->createDestination($match);
        }

        return null;
    }

    /**
     * @param array $match
     * @return Destination
     */
    protected function createDestination(array $match)
    {
        return new Destination(
            $this->getFullControllerClass($match),
            $match[2],
            $this->getArguments($match, 3)
        );
    }

    /**
     * @param array $match
     * @return string
     */
    protected function getFullControllerClass(array $match)
    {
        $class = ucfirst($match[1]) . 'Controller';

        return $this->namespace === ''
            ? $class
            : $this->namespace . '\\' . $class;
    }

    /**
     * @param array $match
     * @param int $offset
     * @return array
     */
    protected function getArguments(array $match, $offset)
    {
        return isset($match[$offset]) ? explode('/', trim($match[$offset], '/')) : array();
    }
}
