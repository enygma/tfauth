<?php

namespace TFAuth\Config;

class Duoauth extends \TFAuth\Config
{
    /**
     * Be sure that our config has:
     *     - a "secret" key
     *     - an "integration" key
     *     - a "hostname"
     * 
     * @param array $config Configuration values
     * @return boolean Pass/fail on validation
     */
    public function validate($config)
    {
        return (
            isset($config['secret']) 
            && isset($config['integration']) 
            && isset($config['hostname'])
        ) ? true : false;
    }
}