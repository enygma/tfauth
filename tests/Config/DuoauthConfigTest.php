<?php

class DuoauthConfigTest extends \PHPUnit_Framework_TestCase
{
    private $config = null;

    public function setUp()
    {
        $this->config = new \TFAuth\Config\Duoauth();
    }

    /**
     * Test the getter setter for the Configuration
     * @covers \TFAuth\Config\Duoauth::getConfig
     * @covers \TFAuth\Config\Duoauth::setConfig
     * @covers \TFAuth\Config\Duoauth::validate
     */
    public function testGetSetConfig()
    {
        $config = array(
            'secret' => '1',
            'integration' => '2',
            'hostname' => '3'
        );

        $this->config->setConfig($config);
        $this->assertEquals($config, $this->config->getConfig());
    }
}