<?php

namespace Mageplaza\Payment\Controller\Index;
use Magento\Framework\Controller\Result\RedirectFactory;

use Mageplaza\Payment\Controller\Index\Config;

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

    public function getOrderId()
    {
        $data = $this->request->getParams();
        $orderId = $data['order_id'];
        return $orderId;
    }

    public function getOrderById()
    {
        $config = new Config($this->context, $this->helperData, $this->resultPageFactory, $this->orderRepository, $this->redirectFactory, $this->request);
        return $config->getOrderById();
    }

    public function getCustomBaseUrl()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        return $storeManager->getStore()->getBaseUrl();
    }

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
            $this->messageManager->addError(__("Something happened wrong"));
        }
        return $redirect;
    }

    public function execute()
    {
        return $this->SuccessOrError();
    }
}
