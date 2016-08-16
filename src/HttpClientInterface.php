<?php

namespace DSteiner23\Light;

/**
 * Class HttpClient
 * @package DSteiner23\Light
 */
interface HttpClientInterface
{
    const REQUEST_TIMEOUT = 3.14;

    const HTTP_OK = 200;

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';

    /**
     * @param   string  $url
     * @return  string
     */
    public static function get($url);

    /**
     * @param   string  $url
     * @param   string  $body
     * @return  boolean
     */
    public static function post($url, $body);

    /**
     * @param   string  $url
     * @param   string  $body
     * @return  boolean
     */
    public static function put($url, $body);
}
