<?php

namespace BodenkoVV\AskQuestion\Observer\Catalog\Model\Product;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\Observer;

/**
 * Class LoadBefore
 * @package BodenkoVV\AskQuestion\Observer\Catalog\Model\Product
 */
class LoadAfter implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(Observer $observer)
    {
        /** @var Product $product */
        $product = $observer->getData('name');
    }
}
