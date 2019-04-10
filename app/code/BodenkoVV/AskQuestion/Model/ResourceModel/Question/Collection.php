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
}
