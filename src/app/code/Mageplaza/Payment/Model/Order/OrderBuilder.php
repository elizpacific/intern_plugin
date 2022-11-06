<?php

namespace Mageplaza\Payment\Model\Order;

use Mageplaza\Payment\Controller\Index\Config;

class OrderBuilder
{
    protected $config;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $orderRepository;
    /**
     * @param \Magento\Framework\View\Result\PageFactory  $resultPageFactory
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        Config $config,
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->orderRepository = $orderRepository;
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $lastOrderId = $objectManager->get('Magento\Checkout\Model\Session')->getLastRealOrder()->getEntityId();

        return $lastOrderId;
    }

    public function getRedirectToInterim()
    {
        $this->config->getInterim();
    }

    public function getOrderByID($client)
    {
        $order = $client->getOrder($this->getOrderId());
        return $order;
    }

    public function getCustomBaseUrl()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        return $storeManager->getStore()->getBaseUrl();
    }

    /**
     * @return array
     */
    public function collectData()
    {
        $resultPage = $this->resultPageFactory->create();
        $order = $this->orderRepository->get($this->getOrderId());
        $customOrder = [
          'merchant_order_id' => $order->getIncrementId(),
          'currency' => $order->getBaseCurrencyCode(),
          'amount' => intval($order->getGrandTotal()) * 100,
          'description' => "Order №". $this->getOrderId(),
          'return_url' => $this->getCustomBaseUrl() . 'mageplaza/index/interim',
          'webhook_url' => $this->getCustomBaseUrl() . 'mageplaza/webhook/request',
          'transactions' => [
              array('payment_method' => 'credit-card'),
          ]
        ];

        return $customOrder;
    }
}
