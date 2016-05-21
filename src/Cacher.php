<?php

namespace DSteiner23\Light;

/**
 * Class Cacher
 * @package DSteiner23\Light
 */
final class Cacher implements CacherInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var integer
     */
    private $ttl;

    /**
     * @var string
     */
    private $fullFilePath;

    /**
     * @param   string  $path
     * @param   integer $ttl
     */
    public function __construct($path, $ttl = CacherInterface::DEFAULT_TTL_IN_MINUTES)
    {
        $this->path = $path;
        $this->fullFilePath = sprintf('%s/%s', $path, CacherInterface::CACHE_FILENAME);
        $this->ttl = $ttl;
    }

    /**
     * @inheritdoc
     */
    public function getCachedLights()
    {
        $cache = $this->readCache();
        return isset($cache['data']) ? $cache['data'] : [];
    }

    /**
     * @inheritdoc
     */
    public function setCachedLights($data)
    {
        return $this->writeCache($data);
    }

    /**
     * @inheritdoc
     */
    public function isCacheExpired($validUntil)
    {
        return $validUntil < time();
    }

    /**
     * @param   string    $data
     * @return  bool
     */
    private function writeCache($data)
    {
        if (!is_dir($this->path)) {
            mkdir($this->path, 0700);
        }

        file_put_contents(
            $this->fullFilePath,
            json_encode(
                [
                    'validUntil' => time() + ($this->ttl * 60),
                    'data' => $data
                ]
            )
        );
    }

    /**
     * @return array
     */
    private function readCache()
    {
        if (!file_exists($this->fullFilePath)) {
            return [];
        }

        return json_decode(file_get_contents($this->fullFilePath), true);
    }
}
