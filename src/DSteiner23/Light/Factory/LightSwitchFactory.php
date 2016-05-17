<?php

namespace DSteiner23\Light\Factory;

use DSteiner23\Light\Bridge;
use DSteiner23\Light\HueCommunication;
use DSteiner23\Light\LightSwitch;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;

/**
 * Class LightSwitchFactory
 * @package DSteiner23\Light\Factory
 */
class LightSwitchFactory
{
    static function build($ip, $username)
    {
        $serializer = SerializerBuilder::create()->build();
        $communication = new HueCommunication(new Client(), $serializer, new Bridge($ip, $username));
        
        return new LightSwitch($communication);
    }
}