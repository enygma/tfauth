<?php

namespace TFAuth;

class Auth
{
    /**
     * Adapter object
     * @var \TFAuth\Adapter
     */
    private $adapter = null;

    /**
     * Path to the Adapter class files
     * @var string
     */
    private $adapterPath = 'Adapter/';

    /**
     * Path to the Config class files
     * @var string
     */
    private $configPath = 'Config/';

    /**
     * Init the object, create the adapter instance and set its config
     * @param string $adapterType Adapter name (Ex. "duoauth" or "gauth")
     * @param array $config Configuration options
     */
    public function __construct($adapterType = null, $config = null)
    {
        if ($adapterType !== null && $config !== null) {
            $adapter = $this->createAdapter($adapterType, $config);
            $this->setAdapter($adapter);
        }
    }

    /**
     * Create the adapter instance for the given type
     * @param string $adapterType Type of adapter to create (Ex. "duoauth")
     * @param array $config Configuration options
     * @return \TFAuth\Adapter instance
     */
    public function createAdapter($adapterType, $config)
    {
        if ($this->isValidAdapter($adapterType) && $this->isValidConfig($adapterType)) {
            // if we're setting up an adapter, it really needs a config so...
            if ($config === null || !is_array($config)) {
                throw new \InvalidArgumentException('Valid configuration must be defined');
            }
            $adapterName = ucwords(strtolower($adapterType));

            $adapterClass = '\\TFAuth\\Adapter\\'.$adapterName;
            $adapter = new $adapterClass();

            $configClass = '\\TFAuth\\Config\\'.$adapterName;
            $config = new $configClass($config);

            $adapter->setConfig($config);

            return $adapter;
        } else {
            throw new \InvalidArgumentException('Invalid adapter/config type "'.$adapterType.'"');
        }
    }

    /**
     * Checks to ensure the adapter type requested is valid
     * @param string $adapterType Type of adapter to check
     * @return boolean Valid/invalid adapter type
     */
    public function isValidAdapter($adapterType)
    {
        $adapterType = ucwords(strtolower($adapterType));
        $adapterPath = __DIR__.'/'.$this->adapterPath.$adapterType.'.php';

        return (is_file($adapterPath)) ? true : false;
    }

    /**
     * Check to ensure the adapter type given has a valid config class
     * @param string $adapterType Type of adapter to check
     * @return boolean Config class found/not found
     */
    public function isValidConfig($adapterType)
    {
        $adapterType = ucwords(strtolower($adapterType));
        $configPath = __DIR__.'/'.$this->configPath.$adapterType.'.php';

        return (is_file($configPath)) ? true : false;
    }

    /**
     * Set the adapter for the current object
     * @param \TFAuth\Adapter $adapter Adapter instance
     */
    public function setAdapter(\TFAuth\Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Get the current adapter
     * @return \TFAuth\Adapter instance
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Set the current configuration
     * @param \TFAuth\Config $config Configuration instance
     */
    public function setConfig(\TFAuth\Config $config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * Get the current configuration object
     * @return \TFAuth\Config instance
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Run the validation on the adapter
     * @param string $code Code to validate
     * @param string $username Username for validation [optional]
     * @return boolean Validation pass/fail
     */
    public function validate($code, $username)
    {
        $adapter = $this->getAdapter();
        return $adapter->validate($code, $username);
    }
}