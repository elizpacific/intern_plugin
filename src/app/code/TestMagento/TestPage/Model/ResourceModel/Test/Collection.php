<?php

namespace TestMagento\TestPage\Model\ResourceModel\Test;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'magento_test_table_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TestMagento\TestPage\Model\Test', 'TestMagento\TestPage\Model\ResourceModel\Test');
    }

}
