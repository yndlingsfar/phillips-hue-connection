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
        socket_sendto(
            $sock,
            $this->getMessage(),
            strlen($this->getMessage()),
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
        return 'M-SEARCH * HTTP/1.1\r\n
            HOST: 239.255.255.250:1900\r\n
            MAN: ssdp:discover\r\n
            MX: 10\r\n
            ST: ssdp:all\r\n
            \r\n';
    }
}
