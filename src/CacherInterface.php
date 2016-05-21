<?php

namespace DSteiner23\Light;

interface CacherInterface
{
    const DEFAULT_TTL_IN_MINUTES = 180;
    const CACHE_FILENAME = 'hue.cache';

    /**
     * Returns an array of light objects from cache
     *
     * @return array
     */
    public function getCachedLights();

    /**
     * Writes hue lights response to cache file
     *
     * @param   string    $data
     * @return  bool
     */
    public function setCachedLights($data);

    /**
     * Checks if current cache is expired. Ttl is defined by DEFAULT_TTL_IN_MINUTES
     *
     * @param   integer$validUntil
     * @return  bool
     */
    public function isCacheExpired($validUntil);
}