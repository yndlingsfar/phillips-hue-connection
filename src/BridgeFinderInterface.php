<?php

namespace DSteiner23\Light;

/**
 * Interface BridgeFinderInterface
 * @package DSteiner23\Light
 */
interface BridgeFinderInterface
{
    const BROADCAST_IP = '239.255.255.250';
    const BROADCAST_PORT = 1900;
    const BROADCAST_TIMEOUT = 2;
    const BROADCAST_BRIDGE_PATTERN = '/LOCATION: (http:\/\/([^:]+):([^\/]+)\/description\.xml)/m';

    /**
     * Performs a broadcast to find all available hue bridges
     *
     * @return array
     */
    public function search();
}
