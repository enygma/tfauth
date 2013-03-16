<?php

namespace TFAuth;

class MockConfig extends Config
{
    public function validate($code, $username = null)
    {
        return true;
    }
}