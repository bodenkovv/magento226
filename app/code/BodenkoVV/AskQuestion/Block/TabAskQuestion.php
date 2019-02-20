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
     * @param CollectionFactory $collectionFactory
     * @param QuestionFactory $questionFactory
     * @param Data $helperData
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Collection $collection,
        CollectionFactory $collectionFactory,
        QuestionFactory $questionFactory,
        Data $helperData,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helperData = $helperData;
        $this->collectionFactory = $collectionFactory;
        $this->collection = $collection;
        $this->questionFactory = $questionFactory;
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
}
