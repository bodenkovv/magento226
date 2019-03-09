<?php

namespace BodenkoVV\AskQuestion\Block;

use BodenkoVV\AskQuestion\Model\ResourceModel\Question\Collection;
use BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use BodenkoVV\AskQuestion\Model\QuestionFactory;
use BodenkoVV\AskQuestion\Helper\Data;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class TabAskQuestion
 * @package BodenkoVV\AskQuestion\Block
 */
class TabAskQuestion extends Template
{
    /**@var CollectionFactory */
    private $collectionFactory;

    /** @var Data $helperData */
    public $helperData;

    /** @var QuestionFactory  */
    public $questionFactory;

    /**
     * Requests constructor.
     * @param Magento\Framework\Registry $registry
     * @param Collection $collection
     * @param CollectionFactory $collectionFactory
     * @param QuestionFactory $questionFactory
     * @param Data $helperData
     * @param Context $context
     * @param array $data
     */
    public function __construct(
//        Collection $collection,
        CollectionFactory $collectionFactory,
        QuestionFactory $questionFactory,
        Data $helperData,
        Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helperData = $helperData;
        $this->collectionFactory = $collectionFactory;
//        $this->collection = $collection;
        $this->questionFactory = $questionFactory;
        $this->_registry = $registry;
    }

    /**
     * @return Collection
     */
    public function getQuestionByProductSku()
    {
//        $collection = $this->collection;
        $collection = $this->collectionFactory->create();
        //$this->helperData,$this->collectionFactory
//        $collection->addStoreFilter($this->collectionFactory, $this->helperData);
        return $collection;
    }

    /**
     * @return Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getQuestions()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection
            ->addFieldToFilter('sku', ['eq' => $this->getCurrentProduct()->getSku()])
            ->getSelect()
            ->orderRand();
        if ($limit = $this->getData('limit')) {
            $collection->setPageSize($limit);
        }
        return $collection;
    }
    /**
     * @return mixed
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
}
