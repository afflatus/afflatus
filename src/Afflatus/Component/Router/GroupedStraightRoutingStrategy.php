<?php
namespace Afflatus\Component\Router;

/**
 * GroupedStraightRoutingStrategy
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.10. 23:30
 */
class GroupedStraightRoutingStrategy extends StraightRoutingStrategy
{
    /**
     * @var string
     */
    protected $regex = '/^\/([a-z]+)\/([a-z]+)\/([a-z]+)([\w\/]+)?$/';

    /**
     * @param array $match
     * @return Destination
     */
    protected function createDestination(array $match)
    {
        return new Destination(
            $this->getFullControllerClass($match),
            $match[3],
            $this->getArguments($match, 4)
        );
    }

    /**
     * @param array $match
     * @return string
     */
    protected function getFullControllerClass(array $match)
    {
        $group = ucfirst($match[1]);
        $class = ucfirst($match[2]) . 'Controller';

        return $this->namespace === ''
            ? $group . $class
            : $this->namespace . '\\' . $group . '\\' . $class;
    }
}
