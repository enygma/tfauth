<?php

require_once 'MockConfig.php';

class AuthTest extends \PHPUnit_Framework_TestCase
{
    private $config = null;

    public function setUp()
    {
        $this->auth = new \TFAuth\Auth();
    }

    /**
     * Test the getter/setter for the config object
     * @covers \TFAuth\Auth::getConfig
     * @covers \TFAuth\Auth::setConfig
     */
    public function testGetSetConfig()
    {
        $config = new \TFAuth\MockConfig(array());

        $this->auth->setConfig($config);
        $this->assertEquals($config, $this->auth->getConfig());
    }
}