<?php

namespace DSteiner23\Light;

/**
 * Class BridgeFinder
 * @package DSteiner23\Light
 *
 * @see inspired by https://github.com/cowlby/php-hue-bindings/blob/master/src/Cowlby/Hue/BridgeManager.php
 */
final class BridgeFinder implements BridgeFinderInterface
{
    /**
     * @inheritdoc
     */
    public function search()
    {
        if (!extension_loaded('sockets')) {
            throw new \RuntimeException('Required php sockets extension is not enabled.');
        }

        $data = $this->performBroadcast();

        return $data;
    }

    /**
     * @return array
     */
    private function performBroadcast()
    {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $message = $this->getMessage();

        socket_sendto(
            $sock,
            $message,
            strlen($message),
            0,
            BridgeFinderInterface::BROADCAST_IP,
            BridgeFinderInterface::BROADCAST_PORT
        );

        $startTime = time();
        $response = [];

        while (time() - $startTime < BridgeFinderInterface::BROADCAST_TIMEOUT) {
            @socket_recv($sock, $data, 1024, MSG_DONTWAIT);
            $data = trim($data);
            if (empty($data)) {
                usleep(10000);
            } else {
                $response[] = $data;
            }
        }
        socket_close($sock);

        return $response;
    }

    /**
     * Creates the required broadcast message
     *
     * @return string
     */
    private function getMessage()
    {
        $message = "M-SEARCH * HTTP/1.1\r\n";
        $message .= "Host: 239.255.255.250:1900\r\n";
        $message .= "Man: \"ssdp:discover\"\r\n";
        $message .= "ST:upnp:rootdevice\r\n";
        $message .= "MX:3\r\n";
        $message .= "\r\n";

        return $message;
    }
}
