<?php

namespace DSteiner23\Light;

use DSteiner23\Light\Models\State;

/**
 * Class LightSwitch
 * @package DSteiner23\Light
 */
class LightSwitch implements LightSwitchInterface
{
    /**
     * @var HueCommunicationInterface
     */
    private $hueCommunication;

    /**
     * @var bool
     */
    private $useCache;

    /**
     * LightSwitch constructor.
     * @param HueCommunicationInterface $hueCommunication
     * @param bool $useCache
     */
    public function __construct(HueCommunicationInterface $hueCommunication, $useCache = true)
    {
        $this->hueCommunication = $hueCommunication;
        $this->useCache = true;
    }

    /**
     * @inheritdoc
     */
    public function getHueCommunication()
    {
        return $this->hueCommunication;
    }

    /**
     * @inheritdoc
     */
    public function switchOn($id)
    {
        $state = new State();
        $state->setOn(true);

        return $this->hueCommunication->putOneBulbState($id, $state);
    }

    /**
     * @inheritdoc
     */
    public function switchOff($id)
    {
        $state = new State();
        $state->setOn(false);

        return $this->hueCommunication->putOneBulbState($id, $state);
    }

    /**
     * @inheritdoc
     */
    public function switchState(
        $id,
        $saturation = State::MAX_SATURATION,
        $brightness = State::MAX_BRIGHTNESS,
        $hue
    ) {

        $state = new State();
        $state->setOn(true)
            ->setHue($hue)
            ->setBrightness($brightness)
            ->setSaturation($saturation);

        return $this->hueCommunication->putOneBulbState($id, $state);
    }

    /**
     * @inheritdoc
     */
    public function getLights()
    {
        if ($this->useCache == false) {
            return $this->hueCommunication->getLights();
        }

        return $this->hueCommunication->getLightsFromCache();
    }
}
