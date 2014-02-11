<?php
namespace Afflatus\Component\Router;

/**
 * SimplifiedRoutePattern
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 21:23
 */
class SimplifiedRoutePattern extends RegexRoutePattern
{
    /**
     * @return string
     */
    public function getUriRegex()
    {
        return '^' .
            preg_replace(
                array(
                    '/\{\w+\}/',
                    '/\//'
                ),
                array(
                    '(\w+)',
                    '\\/'
                ),
                $this->uriRegex
            )
            . '$';
    }
}
