<?php

/**
 * Autoloader
 *
 * @author András Kántor <andr.kantor@gmail.com>
 * @since 2014.01.18. 22:23
 */
class Autoloader
{
    /**
     * @var string
     */
    protected $baseDir;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->baseDir = dirname(__FILE__);
    }

    /**
     * Register
     */
    public function register()
    {
        spl_autoload_register(array($this, 'load'));
    }

    /**
     * @param string $class
     * @throws \Exception
     */
    public function load($class)
    {
        $path = $this->baseDir . '/' . str_replace('\\', '/', $class) . '.php';

        if (!is_file($path)) {
            throw new \Exception('Class: ' . $class . ' cannot loaded because no such file: ' . $path . '!');
        }

        require_once $path;
    }
}
