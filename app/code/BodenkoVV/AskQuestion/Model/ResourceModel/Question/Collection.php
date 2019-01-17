<?php

namespace BodenkoVV\AskQuestion\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(
            \BodenkoVV\AskQuestion\Model\Question::class,
            \BodenkoVV\AskQuestion\Model\ResourceModel\Question::class
        );
    }

    /**
     * @param int $storeId
     * @return Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function addStoreFilter(int $storeId = 0): self
    {
        if (!$storeId) {
            $storeId = (int) $this->storeManager->getStore()->getId();
        }
        $this->addFieldToFilter('store_id', $storeId);
        return $this;
    }
}
