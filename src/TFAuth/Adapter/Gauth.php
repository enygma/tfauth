<?php

namespace TFAuth\Adapter;

class Gauth extends \TFAuth\Adapter
{
    public function validate($code, $username = null)
    {
        $init_code = $this->getConfig()->init;
        $range = $this->getConfig()->range;

        if ($range === null) {
            $range = 3;
        }

        try {
            $gauth = new \GAuth\Auth($init_code);

            // set it to 3 seconds valid range
            $gauth->setRange($range);

            $valid = $gauth->validateCode($code);
            return $valid;
        } catch (\Exception $e) {
            $this->setErrors(array($e->getMessage()));
        }
        return false;
    }
}
