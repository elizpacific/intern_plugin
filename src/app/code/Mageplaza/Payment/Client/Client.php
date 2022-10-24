<?php

namespace Mageplaza\Payment\Client;

use \Ginger\Ginger;
use Mageplaza\Payment\Controller\Index\Config;

class Client
{
    /**
     * @return \Ginger\ApiClient
     */
    public function createClient(Config $config): \Ginger\ApiClient
    {
        $client = Ginger::createClient(
            'https://api.online.emspay.eu',
            $config->helperData->getGeneralConfig('api_key')
//            [
//                CURLOPT_CAINFO => __DIR__ . '../caCERT/cacert.pem.txt'
//            ]
        );

        return $client;
    }

}
