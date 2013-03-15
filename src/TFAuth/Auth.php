<?php

namespace TFAuth;

class Auth
{
    private $adapter = null;

    private $adapterPath = 'Adapter/';

    private $configPath = 'Config/';

    public function __construct($adapterType = null, $config = null)
    {
        if ($adapterType !== null && $config !== null) {
            $adapter = $this->createAdapter($adapterType, $config);
            $this->setAdapter($adapter);
        }
    }

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

    public function isValidAdapter($adapterType)
    {
        $adapterType = ucwords(strtolower($adapterType));
        $adapterPath = __DIR__.'/'.$this->adapterPath.$adapterType.'.php';

        return (is_file($adapterPath)) ? true : false;
    }

    public function isValidConfig($adapterType)
    {
        $adapterType = ucwords(strtolower($adapterType));
        $configPath = __DIR__.'/'.$this->configPath.$adapterType.'.php';

        return (is_file($configPath)) ? true : false;
    }

    public function setAdapter(\TFAuth\Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function setConfig(\TFAuth\Config $config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function validate($username, $code)
    {
        $adapter = $this->getAdapter();
        return $adapter->validate($username, $code);
    }
}