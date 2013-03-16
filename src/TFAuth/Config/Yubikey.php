<?php

namespace TFAuth\Config;

class Yubikey extends \TFAuth\Config
{
    /**
     * Be sure that our config has:
     *     - an API key (api_key)
     *     - a Client ID (client_id)
     * 
     * @param array $config Configuration values
     * @return boolean Pass/fail on validation
     */
    public function validate($config)
    {
        return (
            isset($config['api_key'])
            && isset($config['client_id'])
        ) ? true : false;
    }
}