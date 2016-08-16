<?php

namespace DSteiner23\Light\Factory;

use Doctrine\Common\Annotations\AnnotationRegistry;
use DSteiner23\Light\Bridge;
use DSteiner23\Light\Cacher;
use DSteiner23\Light\HueCommunication;
use DSteiner23\Light\LightSwitch;
use DSteiner23\Light\UserManager;
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
     * @param array $configuration
     * @return LightSwitch
     */
    static function build($ip, $username, $configuration = [])
    {
        $cacheStatus = array_key_exists(Cacher::OPTION_STATUS,
            $configuration) ? $configuration[Cacher::OPTION_STATUS] : true;
        
        $cacheDir = array_key_exists(Cacher::OPTION_DIRECTORY,
            $configuration) ? $configuration[Cacher::OPTION_DIRECTORY] : __DIR__ . '/../../cache';
        
        //Doctrine Annotation Reader registration
        AnnotationRegistry::registerLoader('class_exists');
        
        $serializer = SerializerBuilder::create()->build();
        $communication = new HueCommunication(
            $serializer,
            new Bridge($ip, $username),
            new Cacher($cacheDir),
            new UserManager()
        );

        return new LightSwitch($communication, $cacheStatus);
    }
}
