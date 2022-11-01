<?php

namespace Mageplaza\Payment\Controller\Index;

use Mageplaza\Payment\Controller\Index\Interim;
use Mageplaza\Payment\Model\Order\OrderBuilder;
use Magento\Framework\Controller\Result\RedirectFactory;

class Config extends \Magento\Framework\App\Action\Action
{
    private $client;
    public $helperData;
    public OrderBuilder $builder;
    protected $_logger;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Mageplaza\Payment\Helper\Data $helperData
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Mageplaza\Payment\Helper\Data $helperData,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        RedirectFactory  $redirectFactory,
        \Magento\Framework\App\Request\Http $request,

    )
    {
        $this->redirectFactory = $redirectFactory;
        $this->helperData = $helperData;
        $this->resultPageFactory = $resultPageFactory;
        $this->orderRepository = $orderRepository;
        $this->request = $request;
        $this->context = $context;
        return parent::__construct($context);
    }

    public function setApiClient($client)
    {
//        $client = (new \Mageplaza\Payment\Client\Client)->createClient($this);
        $this->client = $client;
    }

//    public function createApiClient()
//    {
//        $this->setApiClient((new \Mageplaza\Payment\Client\Client)->createClient($this));
//        return $this->getApiClient();
//    }

    public function getApiClient()
    {
        return $this->client;
    }

    /**
     * @return array|null
     */
    public function createApiOrder()
    {
        $this->setApiClient((new \Mageplaza\Payment\Client\Client)->createClient($this));
        $client = $this->getApiClient();
        $data = (new OrderBuilder($this->resultPageFactory, $this->orderRepository, $this))->collectData();
        $apiOrder = $client->createOrder($data);
        return $apiOrder;
    }

    /**
     * @return array
     */
    public function startRequest()
    {
        return $this->createApiOrder();
    }

    public function getOrderById()
    {
        $this->setApiClient((new \Mageplaza\Payment\Client\Client)->createClient($this));
        $client = $this->getApiClient();
        $order = $client->getOrder((new Interim($this->context, $this->request, $this->helperData, $this->resultPageFactory, $this->orderRepository, $this->redirectFactory))->getOrderId());
        return $order;
    }

        public function execute()
    {
        $data = $this->startRequest();
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($data['transactions'][0]['payment_url']);
        return $redirect;
    }

}
