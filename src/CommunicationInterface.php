<?php

namespace DSteiner23\Light;

use DSteiner23\Light\Models\State;

/**
 * Provides basic functionality for interaction with Phillips Hue API
 * 
 * Interface CommunicationInterface
 * @package DSteiner23\Light
 */
interface CommunicationInterface
{
    /**
     * Change the state of a bulb
     *
     * @param $id
     * @param State $state
     * @return bool
     */
    public function putOneBulbState($id, State $state);
}
