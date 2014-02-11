<?php
namespace Afflatus\Component\Router;

/**
 * ControllerFactoryInterface
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:16
 */
interface ControllerFactoryInterface
{
    /**
     * @param string $class
     * @return object
     */
    public function create($class);
}
