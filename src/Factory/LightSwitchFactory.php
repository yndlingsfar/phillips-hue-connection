<?php

namespace DSteiner23\Light\Factory;

use Doctrine\Common\Annotations\AnnotationRegistry;
use DSteiner23\Light\Bridge;
use DSteiner23\Light\Cacher;
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
    /**
     * @param $ip
     * @param $username
     * @return LightSwitch
     */
    static function build($ip, $username)
    {
        //Doctrine Annotation Reader registration
        AnnotationRegistry::registerLoader('class_exists');
        
        $serializer = SerializerBuilder::create()->build();
        $communication = new HueCommunication(
            new Client(),
            $serializer,
            new Bridge($ip, $username),
            new Cacher(__DIR__ . '/../cache')
        );

        return new LightSwitch($communication);
    }
}