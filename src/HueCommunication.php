<?php

namespace DSteiner23\Light;

use DSteiner23\Light\Models\State;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;

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

    /**
     * @inheritdoc
     */
    public function getLights()
    {
        /** @var ResponseInterface $response */
        $response = $this->client->request('GET',
            sprintf(
                '%s/api/%s',
                $this->bridge->getIp(),
                $this->bridge->getUser()
            )
        );

        // Check if request was successful
        if ($response->getStatusCode() != 200) {
            return [];
        }

        // Deserialize response to object
        try {
            $serializer = SerializerBuilder::create()->build();
            return $serializer->deserialize($response->getBody(), 'DSteiner23\Light\Models\Lights', 'json');
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @inheritdoc
     */
    public function putOneBulbState($id, State $state)
    {
        $body = $this->serializer->serialize($state, 'json');

        /** @var ResponseInterface $response */
        $response = $this->client->request('PUT',
            sprintf(
                '%s/api/%s/lights/%d/state',
                $this->bridge->getIp(),
                $this->bridge->getUser(),
                $id
            ),
            ['body' => $body]
        );

        // Check if request was successful
        if ($response->getStatusCode() == 200) {
            return true;
        }

        return false;
    }
}
