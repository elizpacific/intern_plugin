<?php

namespace Mageplaza\Payment\Controller\Index;

use Mageplaza\Payment\Client\Client as Ginger;
use Mageplaza\Payment\Model\Order\OrderBuilder;

class Config extends \Magento\Framework\App\Action\Action
{
    public $helperData;
    public OrderBuilder $builder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Mageplaza\Payment\Helper\Data $helperData,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    )
    {
        $this->helperData = $helperData;
        $this->resultPageFactory = $resultPageFactory;
        $this->orderRepository = $orderRepository;
        return parent::__construct($context);
    }

    public function createApiOrder()
    {
        $client = (new \Mageplaza\Payment\Client\Client)->createClient($this);
        $data = (new OrderBuilder($this->resultPageFactory, $this->orderRepository))->collectData();

        $apiOrder = $client->createOrder($data);

        return $apiOrder;
    }

    public function startRequest()
    {
        return $this->createApiOrder();
    }

    public function execute()
    {
        dd($this->startRequest());
//        dd($this->getRequest()->getParam('id'));
//        dd($client = (new \Mageplaza\Payment\Client\Client)->createClient($this));
//        dd((new OrderBuilder($this->resultPageFactory, $this->orderRepository))->collectData());
    }

}
