<?php

namespace DSteiner23\Light;

use DSteiner23\Light\Models\State;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;

/**
 * Class HueCommunication
 * @package DSteiner23\Light
 */
class HueCommunication implements HueCommunicationInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Bridge
     */
    private $bridge;
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * HueCommunication constructor.
     * @param Client $client
     * @param Serializer $serializer
     * @param Bridge $bridge
     */
    public function __construct(Client $client, Serializer $serializer, Bridge $bridge)
    {
        $this->client = $client;
        $this->bridge = $bridge;
        $this->serializer = $serializer;
    }

    //@todo: implement ID field of bulp
    public function putOneBulbState($id, State $state)
    {
        $body = $this->serializer->serialize($state, 'json');

        return $this->client->request('PUT',
            sprintf(
                '%s/api/%s/lights/%d/state',
                $this->bridge->getIp(),
                $this->bridge->getUser(),
                $id
            ),
            ['body' => $body]
        );
    }
}
