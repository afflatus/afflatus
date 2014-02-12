<?php
namespace Afflatus\Component\Router;

use Afflatus\Component\Router\Exception\ControllerNotFoundException;

/**
 * ControllerFactory
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:20
 */
class ControllerFactory implements ControllerFactoryInterface
{
    /**
     * @param string $class
     * @return object
     * @throws ControllerNotFoundException
     */
    public function create($class)
    {
        try {
            return new $class();
        } catch (\Exception $e) {
            throw new ControllerNotFoundException($class);
        }
    }
}
