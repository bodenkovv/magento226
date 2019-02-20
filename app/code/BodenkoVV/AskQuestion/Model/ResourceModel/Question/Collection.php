<?php

namespace BodenkoVV\AskQuestion\Model\ResourceModel\Question;

use BodenkoVV\AskQuestion\Helper\Data;
use BodenkoVV\AskQuestion\Model\ResourceModel\Question\Collection as QuestionCollection;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package BodenkoVV\AskQuestion\Model\ResourceModel\Question
 */
class Collection extends AbstractCollection
{
    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix = 'askquestion_question_collection';

    /**
     * Name of event parameter
     *
     * @var string
     */
    protected $_eventObject ='eventObject';

    public $collectionFactory;
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

    public function __construct(Data $helperData, \Magento\Store\Model\StoreManagerInterface $storeManager)
    {
        $this->helperData = $helperData;
        $this->storeManager = $storeManager;
//        $this->collectionFactory = $collectionFactory;
    }

//    public function addStoreFilter()
//    {
//        $i=0;
//
//        return $questionCollection;
//    }

}
