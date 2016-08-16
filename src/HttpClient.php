<?php

namespace DSteiner23\Light;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpClient
 * @package DSteiner23\Light
 */
final class HttpClient implements HttpClientInterface
{
    /**
     * @inheritdoc
     */
    public static function get($url)
    {
        /** @var ResponseInterface $response */
        $response = self::createBaseRequest($url, 'GET');

        // Check if request was successful
        if ($response->getStatusCode() == self::HTTP_OK) {
            return (string) $response->getBody();
        }

        return '';
    }

    /**
     * @inheritdoc
     */
    public static function post($url, $body)
    {
        /** @var ResponseInterface $response */
        $response = self::createBaseRequest($url, 'POST', $body);

        // Check if request was successful
        if ($response->getStatusCode() == self::HTTP_OK) {
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public static function put($url, $body)
    {
        /** @var ResponseInterface $response */
        $response = self::createBaseRequest($url, 'PUT', $body);

        // Check if request was successful
        if ($response->getStatusCode() == self::HTTP_OK) {
            return true;
        }

        return false;
    }

    /**
     * @param   string  $url
     * @param   string  $method
     * @param   string  $body
     * @return  ResponseInterface
     */
    private static function createBaseRequest($url, $method, $body = null)
    {
        /** @var ClientInterface $client */
        $client = new Client();

        /** @var ResponseInterface $response */
        return $client->request($method,
            $url,
            ['body' => $body, 'timeout' => self::REQUEST_TIMEOUT]
        );
    }
}
