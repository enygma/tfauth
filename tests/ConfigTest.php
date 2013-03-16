<?php
require_once 'MockConfig.php';

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    private $config = null;

    public function setUp()
    {
        $this->config = new \TFAuth\MockConfig();
    }

    /**
     * Test the getter setter for the Configuration
     * @covers \TFAuth\Config::getConfig
     * @covers \TFAuth\Config::setConfig
     * @covers \TFAuth\Config::validate
     */
    public function testGetSetConfig()
    {
        $config = array(
            'init' => '1',
        );

        $this->config->setConfig($config);
        $this->assertEquals($config, $this->config->getConfig());
    }

    /**
     * Test the getter setter for the Configuration, fetching as object property
     * @covers \TFAuth\Config::__get
     * @covers \TFAuth\Config::setConfig
     * @covers \TFAuth\Config::validate
     */
    public function testGetSetConfigProperty()
    {
        $init = 'test';
        $config = array('init' => $init);

        $this->config->setConfig($config);
        $this->assertEquals($this->config->init, $init);
    }
}