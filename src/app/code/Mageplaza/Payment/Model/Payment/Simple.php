<?php
namespace Mageplaza\Payment\Model\Payment;
/**
 * Custom Payment Method Model
 */
class Simple extends \Magento\Payment\Model\Method\AbstractMethod {
    /**
     * Payment Method code
     *
     * @var string
     */
    protected $_code = 'simple';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

    const CODE = 'simple';

}
