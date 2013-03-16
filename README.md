TFAuth: Unified Two-Factor Client
=====================

[![Build Status](https://secure.travis-ci.org/enygma/tfauth.png?branch=master)](http://travis-ci.org/enygma/tfauth)

The goal of TFAuth is to provide an easy way for developers to integrate multiple 
two-factor authentication methods into their application.

Options included are (or will be):

- [Duo Security](http://duosecurity.com)
- [Yubikey](http://yubico.com)
- [Google Authenticator](https://code.google.com/p/google-authenticator)

Basic Usage:
=====================

```php
<?php
require_once 'vendor/autoload.php';

/**
 * This script can be called from the command line like:
 * 
 * ./test.php [duo|gauth] [code] [username]
 */

$code = $_SERVER['argv'][2];
$username = (isset($_SERVER['argv'][3])) ? $_SERVER['argv'][3] : '';

switch ($_SERVER['argv'][1]) {
    case 'duo':
        $config = array(
            'secret' => 'duo-security-secret-key',
            'integration' => 'duo-security-integration-key',
            'hostname' => 'duo-security-hostname'
        );
        $type = 'duoauth';
        break;
    case 'gauth':
        $config = array(
            'init' => 'gauth-init-key'
        );
        $type = 'gauth';
        break;
}
echo 'Validating code "'.$code.'" for user "'.$username .'"'."\n\n";

try {
    $tfa = new \TFAuth\Auth($type, $config);
    $result = $tfa->validate($code, $username);

    echo 'result: '.var_export($result, true)."\n\n";    
} catch (\Exception $e) {
    echo 'ERROR: '.$e->getMessage()."\n\n";
}

?>
```