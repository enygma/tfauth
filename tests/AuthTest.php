<?php

require_once 'MockConfig.php';
require_once 'MockAdapter.php';

class AuthTest extends \PHPUnit_Framework_TestCase
{
    private $config = null;

    public function setUp()
    {
        $this->auth = new \TFAuth\Auth();
    }

    /**
     * Test the init of the object, creating an adapter
     * @covers \TFAuth\Auth::__construct
     * @covers \TFAuth\Auth::getAdapter
     */
    public function testInitWithAdapter()
    {
        $adapter = 'gauth';
        $config = array('init' => 'test');

        $auth = new \TFAuth\Auth($adapter, $config);

        $this->assertTrue(
            $auth->getAdapter() instanceof \TFAuth\Adapter
        );
    }

    /**
     * Test that exception is thrown when the configuration isn't an array
     * @covers \TFAuth\Auth::createAdapter
     * @covers \TFAuth\Auth::isValidAdapter
     * @covers \TFAuth\Auth::isValidConfig
     * @expectedException \InvalidArgumentException
     */
    public function testCreateAdapterConfigNotArray()
    {
        $this->auth->createAdapter('duoauth', 'badconfig');
    }

    /**
     * Test that exception is thrown when bad adapter type is given
     * @covers \TFAuth\Auth::createAdapter
     * @expectedException \InvalidArgumentException
     */
    public function testCeateInvalidAdapter()
    {
        $this->auth->createAdapter('badadapter', array());
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

    /**
     * Test the result of a successful validate call
     * @covers \TFAuth\Auth::setAdapter
     * @covers \TFAuth\Auth::validate
     */
    public function testValidateOnAdapter()
    {
        $code = '1234';
        $adapter = new \TFAuth\MockAdapter();
        $this->auth->setAdapter($adapter);

        $result = $this->auth->validate($code, 'testuser1');
        $this->assertTrue($result);
    }
}