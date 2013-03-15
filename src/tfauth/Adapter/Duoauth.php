<?php

namespace TFAuth\Adapter;

class Duoauth extends \TFAuth\Adapter
{
    public function validate($username, $code)
    {
        echo 'validating code: '.$code."\n\n";

        $config = $this->getConfig();
        print_r($config);

        $user = new \DuoAuth\User();
        $user->setConfig($config->getConfig());

        $int = $user->getIntegration();
        $valid = $user->validateCode($code, $username);

        $this->setErrors(\DuoAuth\Error::get());

        return $valid;
    }
}