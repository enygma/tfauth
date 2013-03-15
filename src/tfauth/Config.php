<?php

namespace TFAuth;

abstract class Config
{
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
    }

    public function getConfig($key = null)
    {
        return ($key !== null && isset($this->config[$key]))
            ? $this->config[$key] : $this->config;
    }
}