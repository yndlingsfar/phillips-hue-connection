<?php

namespace DSteiner23\Light;

use DSteiner23\Light\Models\State;
use DSteiner23\Light\Models\User;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * Class HueCommunication
 * @package DSteiner23\Light
 */
class HueCommunication implements HueCommunicationInterface
{
    /**
     * @var Bridge
     */
    private $bridge;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var CacherInterface
     */
    private $cacher;

    /**
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * HueCommunication constructor.
     * @param Serializer $serializer
     * @param Bridge $bridge
     * @param CacherInterface $cacher
     */
    public function __construct(
        Serializer $serializer,
        Bridge $bridge,
        CacherInterface $cacher,
        UserManagerInterface $userManager
    ) {
        $this->bridge = $bridge;
        $this->serializer = $serializer;
        $this->cacher = $cacher;
        $this->userManager = $userManager;
    }

    /**
     * @inheritdoc
     */
    public function getLights()
    {
        $response = HttpClient::get(sprintf('%s/api/%s', $this->bridge->getIp(), $this->bridge->getUser()));

        // Check if request was successful
        if (!$response) {
            return [];
        }

        // Write response to cache
        $this->cacher->setCachedLights($response);

        // Deserialize response to object
        return $this->deserializeLights($response);
    }

    /**
     * @inheritdoc
     */
    public function getLightsFromCache()
    {
        $lights = $this->cacher->getCachedLights();

        if (!empty($lights) && !$this->cacher->isCacheExpired($lights['validUntil'])) {
            return $this->deserializeLights($lights['data']);
        }

        // Cache is empty or expired. Perform new guzzle request
        return $this->getLights();
    }

    public function createUser($username, $devicetype)
    {
        /** @var User $user */
        $user = $this->userManager->create($username, $devicetype);

        $body = $this->serializer->serialize($user, 'json');

        return HttpClient::post(
            sprintf('%s/api', $this->bridge->getIp()),
            $body
        );
    }

    /**
     * @inheritdoc
     */
    public function putOneBulbState($id, State $state)
    {
        $body = $this->serializer->serialize($state, 'json');

        return HttpClient::put(
            sprintf(
                '%s/api/%s/lights/%d/state',
                $this->bridge->getIp(),
                $this->bridge->getUser(),
                $id
            ),
            $body
        );
    }

    /**
     * @param   string  $data
     * @return  array
     */
    private function deserializeLights($data)
    {
        try {
            $serializer = SerializerBuilder::create()->build();
            return $serializer->deserialize($data, 'DSteiner23\Light\Models\Lights', 'json');
        } catch (\Exception $e) {
            return [];
        }
    }
}
