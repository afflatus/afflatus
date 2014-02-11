<?php
namespace Afflatus\Component\Router\Tests;

/**
 * TestController
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 16:25
 */
class TestController
{
    /**
     * @var bool
     */
    protected $actionInvoked = false;

    /**
     * @return boolean
     */
    public function getActionInvoked()
    {
        return $this->actionInvoked;
    }

    public function indexAction()
    {
        $this->actionInvoked = true;
    }
}
