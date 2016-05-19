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

Register vendor autoloader and doctrine Annoation registry somewhere in your bootstraping file

````
require __DIR__ . '/vendor/autoload.php';
// JMS Serializer Annoations
\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
    'JMS\Serializer\Annotation', __DIR__.'/vendor/jms/serializer/src'
);
````

__Usage__

````
$lightSwitch = \DSteiner23\Light\Factory\LightSwitchFactory::build('192.168.100.1', 'abcedefghijklmno');
$lightSwitch->switchState(1, 300, 300, 500);
````
