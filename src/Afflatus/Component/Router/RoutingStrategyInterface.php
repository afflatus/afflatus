<?php
namespace Afflatus\Component\Router;

/**
 * RoutingStrategyInterface
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 21:04
 */
interface RoutingStrategyInterface
{
    /**
     * @param $requestUri
     * @param $requestMethod
     * @return Destination
     */
    public function findDestination($requestUri, $requestMethod);
}
