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
     * @var CommunicationInterface
     */
    private $communication;

    /**
     * LightSwitch constructor.
     * @param CommunicationInterface $communication
     */
    public function __construct(CommunicationInterface $communication)
    {
        $this->communication = $communication;
    }

    public function switchOn($id)
    {
        // TODO: Implement switchOn() method.
    }

    public function switchOff($id)
    {
        // TODO: Implement switchOff() method.
    }

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

        return $this->communication->putOneBulbState($id, $state);
    }
}
