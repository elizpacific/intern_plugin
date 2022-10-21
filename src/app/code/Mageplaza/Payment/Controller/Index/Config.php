<?php

namespace Mageplaza\Payment\Controller\Index;

use Mageplaza\Payment\Model\Order\OrderBuilder;
use Mageplaza\Payment\Client\Client as Ginger;
use http\Client;

class Config extends \Magento\Framework\App\Action\Action
{

    public $helperData;
    public OrderBuilder $builder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Mageplaza\Payment\Helper\Data $helperData

    )
    {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    public function execute($builder)
    {
//        dd((new \Mageplaza\Payment\Client\Client)->createClient($this));

//
//        $client = Ginger::createClient($this);
//        dd($client->getIdealIssuers());

        exit();

    }
}
