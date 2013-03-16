<?php

namespace TFAuth\Config;

class Gauth extends \TFAuth\Config
{
    /**
     * Be sure that our config has:
     *     - an "integration" code (init_code)
     * 
     * @param array $config Configuration values
     * @return boolean Pass/fail on validation
     */
    public function validate($config)
    {
        return (isset($config['init'])) ? true : false;
    }
}