<?php
namespace Afflatus\Component\Router;

/**
 * RegexRoutingStrategy
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.02.09. 21:06
 */
class RegexRoutingStrategy implements RoutingStrategyInterface
{
    /**
     * @var RegexRoutePatternInterface[]
     */
    protected $patterns;

    /**
     * @param array $patterns
     */
    public function __construct(array $patterns = array())
    {
        foreach ($patterns as $pattern) {
            $this->addPattern($pattern);
        }
    }

    /**
     * @param RegexRoutePatternInterface $pattern
     */
    public function addPattern(RegexRoutePatternInterface $pattern)
    {
        $this->patterns[] = $pattern;
    }

    /**
     * @param $requestUri
     * @param $requestMethod
     * @return Destination
     */
    public function findDestination($requestUri, $requestMethod)
    {
        $maxPriority = 0;
        $destination = null;

        foreach ($this->patterns as $pattern) {
            if (preg_match('/' . $pattern->getUriRegex() . '/', $requestUri, $match)
                && $pattern->matchRequestMethod($requestMethod)
                && $maxPriority < $pattern->getPriority()
            ) {
                unset($match[0]);

                $destination = $this->createDestination($pattern, array_values($match));
                $maxPriority = $pattern->getPriority();
            }
        }

        return $destination;
    }

    /**
     * @param RegexRoutePatternInterface $pattern
     * @param array $arguments
     * @return Destination
     */
    protected function createDestination(RegexRoutePatternInterface $pattern, array $arguments)
    {
        return new Destination(
            $pattern->getControllerClass(),
            $pattern->getAction(),
            $arguments
        );
    }
}
