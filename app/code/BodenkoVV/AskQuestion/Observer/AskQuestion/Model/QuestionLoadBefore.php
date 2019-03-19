<?php

namespace BodenkoVV\AskQuestion\Observer\AskQuestion\Model;

use BodenkoVV\AskQuestion\Helper\Data;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class LoadBefore
 * @package BodenkoVV\AskQuestion\Observer\Catalog\Model\Product
 */
class QuestionLoadBefore implements ObserverInterface
{
    /** @var  $helperData */
    protected $helperData;

    /**
     * QuestionLoadBefore constructor.
     * @param Data $helperData
     */
    public function __construct(
        Data $helperData
    ) {
        $this->helperData = $helperData;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var Data/Product $product */
        $product = $this->helperData->getCurrentProduct();
        if (isset($product)) {
            $collectionQuestion = $observer->getData('eventObject');
            $collectionQuestion ->addFieldToFilter('product_id', ['eq'=>$product->getEntityId()]);
        }
    }
}
