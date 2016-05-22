[![Packagist License](https://poser.pugx.org/barryvdh/laravel-debugbar/license.png)](http://choosealicense.com/licenses/mit/)
[![Build Status](https://travis-ci.org/dsteiner23/phillips-hue-connection.svg?branch=master)](https://travis-ci.org/dsteiner23/phillips-hue-connection)
[![Latest Stable Version](https://poser.pugx.org/dsteiner23/phillips-hue-connection/v/stable)](https://packagist.org/packages/dsteiner23/phillips-hue-connection)

# phillips-hue-connection
Provides basic functionality for the Philllips Hue debug API

__Installation__

````
composer require dsteiner23/phillips-hue-connection
````

__Autoloading__

Register vendor autoloader and doctrine somewhere in your bootstraping file

````
require __DIR__ . '/vendor/autoload.php';
````

__Usage__

````
$config = [
    'cache_enabled' => false, // default to true
    'cache_dir' => __DIR__ . '/yourDir' // default to /src/cache
];

$lightSwitch = \DSteiner23\Light\Factory\LightSwitchFactory::build(
    '192.168.100.1',
    'abcedefghijklmno',
    $config
);

$lightSwitch->switchState($id, $saturation, $brightness, $hue);

* $id: The unique Id of your Bulb
* $saturation: integer 0-255
* $brightness: integer 0-255
* $hue: The color 0 - 65000
````
