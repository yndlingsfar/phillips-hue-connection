<?php

namespace DSteiner23\Light\Models;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Lights
 * @package DSteiner23\Light
 */
class Lights
{
    /**
     * @var Bulb[]
     * @Serializer\SerializedName("lights")
     * @Serializer\Type("array<integer, DSteiner23\Light\Models\Bulb>")
     */
    private $lights;

    /**
     * @return Bulb[]
     */
    public function getLights()
    {
        return $this->lights;
    }

    /**
     * @param Bulb[] $lights
     */
    public function setLights($lights)
    {
        $this->lights = $lights;
    }
}
