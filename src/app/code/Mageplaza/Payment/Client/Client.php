<?php

namespace Mageplaza\Payment\Client;

use \Ginger\Ginger;
use Mageplaza\Payment\Controller\Index\Config;

class Client
{
    /**
     * @param Config $config
     * @return \Ginger\ApiClient
     */
    public function createClient(Config $config)
    {
        $apiClient = Ginger::createClient(
            'https://api.online.emspay.eu',
            $config->helperData->getGeneralConfig('api_key'),
            [
                CURLOPT_CAINFO => __DIR__ . '/../caCERT/cacert.pem'
            ]
        );

        return $apiClient;
    }

}
