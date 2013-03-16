<?php

namespace TFAuth\Adapter;

class Duoauth extends \TFAuth\Adapter
{
    public function validate($code, $username = null)
    {
        $config = $this->getConfig();

        $user = new \DuoAuth\User();
        $user->setConfig($config->getConfig());

        $int = $user->getIntegration();
        $valid = $user->validateCode($code, $username);

        $this->setErrors(\DuoAuth\Error::get());

        return $valid;
    }
}