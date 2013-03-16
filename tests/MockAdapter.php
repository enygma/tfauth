<?php

namespace TFAuth;

class MockAdapter extends Adapter
{
    public function validate($code, $username = null)
    {
        return true;
    }
}