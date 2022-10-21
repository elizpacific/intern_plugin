<?php

namespace Mageplaza\Payment\Model\Order;

use Magento\Framework\App\ResponseInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

use Magento\Framework\App\Filesystem\DirectoryList;
class OrderBuilder extends \Magento\Sales\Controller\Adminhtml\Order
{
    public function getId()
    {
        $orderId = $this->getRequest()->getParam('order_id');
        $order = $this->orderRepository->get($orderId);
        return $order;
    }

//    public function createOrder()
//    {
//        $order = [
//            'order_id' => $this->getId(),
//        ];
//
//        return ;
//    }

    public function execute()
    {
    }
}
