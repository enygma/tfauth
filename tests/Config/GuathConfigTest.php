<?php

class GauthConfigTest extends \PHPUnit_Framework_TestCase
{
    private $config = null;

    public function setUp()
    {
        $this->config = new \TFAuth\Config\Gauth();
    }

    /**
     * Test the getter setter for the Configuration
     * @covers \TFAuth\Config\Gauth::getConfig
     * @covers \TFAuth\Config\Gauth::setConfig
     * @covers \TFAuth\Config\Gauth::validate
     */
    public function testGetSetConfig()
    {
        $config = array(
            'init' => '1',
        );

        $this->config->setConfig($config);
        $this->assertEquals($config, $this->config->getConfig());
    }
}