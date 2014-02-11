<?php
namespace Afflatus\Component\Router\Exception;

/**
 * ControllerNotFoundException
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:21
 */
class ControllerNotFoundException extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Controller not found with class: %s !';

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        $this->message = sprintf($this->message, $class);
    }
}
