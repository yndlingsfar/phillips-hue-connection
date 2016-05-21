<?php

namespace DSteiner23\Light;

use DSteiner23\Light\Models\State;

/**
 * Provides basic functionality for interaction with Phillips Hue API
 * 
 * Interface HueCommunicationInterface
 * @package DSteiner23\Light
 */
interface HueCommunicationInterface
{
    /**
     * Returns all available lights as array of objects
     *
     * @return array
     */
    public function getLights();

    /**
     * Returns all available lights as array of objects from cache
     *
     * @return array
     */
    public function getLightsFromCache();

    /**
     * Change the state of a bulb
     *
     * @param $id
     * @param State $state
     * @return bool
     */
    public function putOneBulbState($id, State $state);
}
