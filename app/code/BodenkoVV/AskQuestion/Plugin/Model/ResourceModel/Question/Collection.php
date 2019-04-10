<?php
namespace VVBodenko\AskQuestion\Plugin\Model\ResourceModel\Question;

use VVBodenko\AskQuestion\Model\ResourceModel\Question\Collection as ProductCollection;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
/**
 * Class Collection
 * @package VVBodenko\AskQuestion\Plugin\AskQuestion\Model\ResourceModel\AskQuestion
 */
class Collection extends AbstractCollection
{
    /**
     * Collection constructor.
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * @param ProductCollection $subject
     * @param \Closure $proceed
     * @param bool $printQuery
     * @param bool $logQuery
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function aroundLoad(ProductCollection $subject, \Closure $proceed, $printQuery = false, $logQuery = false)
    {
        $storeId = (int) $this->storeManager->getStore()->getStoreId();
        $subject->addFieldToFilter('store_id', $storeId);
        $result = $proceed($printQuery, $logQuery);
        return $result;
    }
}