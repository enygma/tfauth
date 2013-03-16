<?php

namespace TFAuth;

abstract class Config
{
    /**
     * Current configuration settings
     * @var array
     */
    private $config = array();

    /**
     * Validate that the configuration given is valid
     * @param array $config Configuration settings
     */
    abstract public function validate($config);

    public function __construct($config = null)
    {
        if ($config !== null) {
            $this->setConfig($config);
        }
    }

    /**
     * Allow for the fetching of config options as properties
     * @param string $name Config key name
     * @return mixed If found, the config value. If not null
     */
    public function __get($name)
    {
        return (isset($this->config[$name])) ? $this->config[$name] : null;
    }

    /**
     * Set the configuration of the current instance
     * @param array $config Configuration settings
     * @return \TFAuth\Config instance
     */
    public function setConfig($config)
    {
        if (!is_array($config)) {
            throw new \InvalidArgumentException('Configuration must be an array');
        }
        if ($this->validate($config) !== true) {
            throw new \InvalidArgumentException('Configuration could not be validated');
        } else {
            $this->config = $config;
        }
        return $this;
    }

    /**
     * Get either the entire set of config settings or a single value
     * @param string $key Configuration key to try to locate [optional]
     * @return array|string Either the one value if key is found, otherwise all settings
     */
    public function getConfig($key = null)
    {
        return ($key !== null && isset($this->config[$key]))
            ? $this->config[$key] : $this->config;
    }
}