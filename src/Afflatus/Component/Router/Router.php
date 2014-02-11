<?php
namespace Afflatus\Component\Router;

/**
 * Router
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:03
 */
class Router
{
    /**
     * @var RoutingStrategyInterface[]
     */
    protected $strategies;

    /**
     * @param RoutingStrategyInterface $strategy
     */
    public function addStrategy(RoutingStrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;
    }

    /**
     * @param string $requestUri
     * @param string $requestMethod
     * @return Destination
     */
    public function findDestination($requestUri, $requestMethod)
    {
        foreach ($this->strategies as $strategy) {
            $destination = $strategy->findDestination($requestUri, $requestMethod);

            if (!is_null($destination)) {
                return $destination;
            }
        }

        return null;
    }
}
