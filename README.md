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

$code = '12345';
$username = 'ccornutt';

$config = array(
    'secret' => 'duo-security-secret-key',
    'integration' => 'duo-security-integration-key',
    'hostname' => 'duo-security-hostname'
);

try {
    $tfa = new \TFAuth\Auth('duoauth', $config);
    $result = $tfa->validate($username, $code);

    echo 'result: '.var_export($result, true)."\n\n";    
} catch (\Exception $e) {
    echo 'ERROR: '.$e->getMessage()."\n\n";
}
?>
```