<?php

namespace TFAuth\Adapter;

class Yubikey extends \TFAuth\Adapter
{
    public function validate($code, $username = null)
    {
        $config = $this->getConfig();

        try {
            $v = new \Yubikey\Validate($config->api_key, $config->client_id);
            $response = $v->check($code);

            return ($response->success() === true) ? true : false;
        } catch (\Exception $e) {
            $this->setErrors(array($e->getMessage()));
        }
        return false;
    }
}