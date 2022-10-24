<?php

namespace Mageplaza\Payment\Model\Order;

class OrderBuilder
{
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
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->orderRepository = $orderRepository;
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
          'amount' => intval($order->getGrandTotal()),
          'description' => "Order №". $this->getOrderId(),
          'payment_method' => "iDeal",
//          'return_url' => $this->getURL()
        ];

        return $customOrder;
    }

//    public function getURL()
//    {
//        return $this->getURL('https://magento.test/checkout/onepage/success/');
//    }
}
