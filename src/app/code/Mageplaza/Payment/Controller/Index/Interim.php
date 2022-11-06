<?php

namespace Mageplaza\Payment\Controller\Index;

use Magento\Framework\Controller\Result\RedirectFactory;

class Interim extends \Magento\Framework\App\Action\Action
{
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Mageplaza\Payment\Helper\Data $helperData,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        RedirectFactory  $redirectFactory,
    )
    {
        $this->request = $request;
        $this->redirectFactory = $redirectFactory;
        $this->helperData = $helperData;
        $this->resultPageFactory = $resultPageFactory;
        $this->orderRepository = $orderRepository;
        $this->context = $context;

        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        $data = $this->request->getParams();
        $orderId = $data['order_id'];
        return $orderId;
    }

    /**
     * @return mixed
     */
    public function getOrderById()
    {
        $config = new Config($this->context, $this->helperData, $this->resultPageFactory, $this->orderRepository, $this->redirectFactory, $this->request);
        return $config->getOrderById();
    }

    /**
     * @return mixed
     */
    public function getCustomBaseUrl()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        return $storeManager->getStore()->getBaseUrl();
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function SuccessOrError()
    {
        $result = $this->getOrderById();
        $result = $result['status'];
        if ($result == 'completed') {
            $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            $redirect->setUrl($this->getCustomBaseUrl() . 'checkout/onepage/success/');
        }
        else{
            $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            $redirect->setUrl($this->getCustomBaseUrl());
            $this->messageManager->addError(__("Something went wrong"));
        }
        return $redirect;
    }

    /**
     * @return mixed
     */
    public function getEntiryId()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $lastOrderId = $objectManager->get('Magento\Checkout\Model\Session')->getLastRealOrder()->getEntityId();

        return $lastOrderId;
    }

    public function insertData()
    {
        $result = $this->getOrderById();
        $status = $result['status'];
        $orderId = $this->getEntiryId();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('api_orders');

        $sql = "Insert Into " . $tableName . " (id, status) Values ( '$orderId' , '$status')";
        $connection->query($sql);
    }

    public function execute()
    {
        $this->insertData();
        return $this->SuccessOrError();
    }
}
