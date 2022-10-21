<?php

namespace TestMagento\TestPage\Model;

use TestMagento\TestPage\Api\Data\TestInterface;
use \Magento\Framework\DataObject\IdentityInterface;

class Test extends \Magento\Framework\Model\AbstractModel implements IdentityInterface, TestInterface
{
    const CACHE_TAG = 'magento_test_table';

    protected $_cacheTag = 'magento_test_table';

    protected $_eventPrefix = 'magento_test_table';

    protected function _construct()
    {
        $this->_init('TestMagento\TestPage\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function getPostContent()
    {
        return $this->getData(self::POST_CONTENT);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);

    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function setPostContent($post_content)
    {
        return $this->setData(self::POST_CONTENT, $post_content);

    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);

    }
}
