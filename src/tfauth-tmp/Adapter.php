<?php

namespace TFAuth;

abstract class Adapter
{
    private $config = array();

    private $errors = array();

    abstract public function validate($username, $code);

    public function setConfig(\TFAuth\Config $config)
    {
        $this->config = $config;
    }

    public function getConfig($key = null)
    {
        return ($key !== null && isset($this->config[$key]))
            ? $this->config[$key] : $this->config;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
}