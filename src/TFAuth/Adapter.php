<?php

namespace TFAuth;

abstract class Adapter
{
    /**
     * Configuration object
     * @var \TFAuth\Config
     */
    private $config = null;

    /**
     * Errors from the validation
     * @var array
     */
    private $errors = array();

    /**
     * Validate method definition (for code validation)
     * @param string $code Code to validate
     * @param string $username Username for validation [optional]
     * @return boolean Success/fail of validation
     */
    abstract public function validate($code, $username = null);

    /**
     * Set the configuration for the adapter
     * @param \TFAuth\Config $config Configuration instance
     */
    public function setConfig(\TFAuth\Config $config)
    {
        $this->config = $config;
    }

    /**
     * Get either a single config value or all configuration
     * @param string $key Config key to find [optional]
     * @return mixed If found, returns option. If not, all config
     */
    public function getConfig($key = null)
    {
        return ($key !== null && isset($this->config->$key))
            ? $this->config->$key : $this->config;
    }

    /**
     * Get the current errors for the validation
     * @return array Set of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the errors for the validation
     * @param array $errors Errors found
     */
    public function setErrors($errors)
    {
        if (!is_array($errors)) {
            throw new \InvalidArgumentException('Error list must be an array');
        }
        $this->errors = $errors;
    }
}