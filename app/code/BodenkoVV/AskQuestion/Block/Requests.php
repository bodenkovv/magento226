<?php

namespace BodenkoVV\AskQuestion\Block;

use \BodenkoVV\AskQuestion\Model\ResourceModel\Question\Collection;
use \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Requests
 * @package BodenkoVV\AskQuestion\Block
 */
class Requests extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $productCollectionFactory;
    /**
     * Requests constructor.
     * @param CollectionFactory $collectionFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
//        CollectionFactory $collectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
//        $this->collectionFactory = $collectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * @return Collection
     */
    public function getSampleRequests()
    {
        /** @var $productCollection \Magento\Catalog\Model\ResourceModel\Product\Collection */
        $productCollection = $this->productCollectionFactory->create();
        $productCollection->addStoreFilter()
            ->getSelect()
            ->orderRand();
        if ($limit = $this->getData('limit')) {
            $productCollection->setPageSize($limit);
        }
        return $productCollection;
    }
}
