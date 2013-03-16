<?php
require_once 'MockAdapter.php';
require_once 'MockConfig.php';

class AdapterTest extends \PHPUnit_Framework_TestCase
{
    private $config = null;

    public function setUp()
    {
        $this->adapter = new \TFAuth\MockAdapter();
    }

    /**
     * Test the setting of a valid configuration object
     * @covers \TFAuth\Adapter::setConfig
     * @covers \TFAuth\Adapter::getConfig
     */
    public function testGetSetConfigValid()
    {
        $config = new \TFAuth\MockConfig(array());

        $this->adapter->setConfig($config);
        $this->assertEquals($config, $this->adapter->getConfig());
    }

    /**
     * Test the valid setting/getting of the error list
     * @covers \TFAuth\Adapter::getErrors
     * @covers \TFAuth\Adapter::setErrors
     */
    public function testGetSetErrors()
    {
        $errors = array(
            'oh noes! you failed!'
        );

        $this->adapter->setErrors($errors);
        $this->assertEquals($this->adapter->getErrors(), $errors);
    }

    /**
     * Test that an exception is thrown when we try to set a non-array value
     * @expectedException \InvalidArgumentException
     */
    public function testSetErrorsNotArray()
    {
        $this->adapter->setErrors('bad value');
    }
}