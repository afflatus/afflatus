<?php
namespace Afflatus\Component\Router;

/**
 * RegexRoutePatternInterface
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 17:02
 */
interface RegexRoutePatternInterface
{
    /**
     * @return string
     */
    public function getUriRegex();

    /**
     * @return string
     */
    public function getControllerClass();

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return string
     */
    public function getRequestMethod();

    /**
     * @return int
     */
    public function getPriority();

    /**
     * @param string $requestMethod
     * @return bool
     */
    public function matchRequestMethod($requestMethod);
}
