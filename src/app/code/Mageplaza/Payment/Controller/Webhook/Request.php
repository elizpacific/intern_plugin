<?php

namespace Mageplaza\Payment\Controller\Webhook;

use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;

class Request extends \Magento\Framework\App\Action\Action implements CsrfAwareActionInterface
{
    public function createCsrfValidationException(RequestInterface $request): ? InvalidRequestException
    {
        return null;
    }

    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
    ) {
        $this->orderRepository = $orderRepository;
        return parent::__construct($context);

    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return json_decode($json = file_get_contents("php://input"),true);
    }

    /**
     * @param $orderId
     * @param $status
     * @return void
     */
    public function changeStatus($orderId, $status)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('\Magento\Sales\Model\Order')->load($orderId);
        $order->setState($status)->setStatus($status);
        $order->save();
    }

    /**
     * @param $orderId
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function getMagentoOrder($orderId)
    {
        return $this->orderRepository->get($orderId);
    }

    public function getStatus()
    {
        $data = $this->getData();
        $order = $this->getMagentoOrder($data['order_id']);
        return $order['status'];
    }

    public function getId()
    {
        $data = $this->getData();
        $id = $data['order_id'];
        $order = $this->getMagentoOrder($id);

        return $order['entity_id'];
    }

    public function getTable()
    {
        $objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        return $connection->fetchAll("SELECT * FROM api_orders");
    }

    public function getApiOrderId($id)
    {
        $table = $this->getTable();
        foreach ($table as $value){
            if( $value['id'] == $id){
                return $value;
            }
        }
    }

    public function execute()
    {
        $id = $this->getId();
        $data = $this->getApiOrderId((int)$id);
        $status = $data['status'];

        $this->changeStatus($id, $status);
//        dd(123);
    }
}
