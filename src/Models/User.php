<?php

namespace DSteiner23\Light\Models;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class User
 * @package DSteiner23\Light
 */
class User
{
    /**
     * @var string
     * @Serializer\SerializedName("username")
     * @Serializer\Type("string")
     */
    private $username;

    /**
     * @var string
     * @Serializer\SerializedName("devicetype")
     * @Serializer\Type("string")
     */
    private $devicetype;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getDevicetype()
    {
        return $this->devicetype;
    }

    /**
     * @param string $devicetype
     */
    public function setDevicetype($devicetype)
    {
        $this->devicetype = $devicetype;
    }
}
