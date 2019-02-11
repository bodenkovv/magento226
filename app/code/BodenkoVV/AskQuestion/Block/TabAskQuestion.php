<?php

namespace BodenkoVV\AskQuestion\Block;

use \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use \BodenkoVV\AskQuestion\Model\QuestionFactory;
use \BodenkoVV\AskQuestion\Helper\Data;

/**
 * Class TabAskQuestion
 * @package BodenkoVV\AskQuestion\Block
 */
class TabAskQuestion extends \Magento\Framework\View\Element\Template
{
    /**@var \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory      */
    private $collectionFactory;

    /** @var Data $_helperData */
    public $_helperData;

    /** @var QuestionFactory  */
    public $questionFactory;
    /**
     * Requests constructor.
     * @param CollectionFactory $collectionFactory
     * @param Data $helperData
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        QuestionFactory $questionFactory,
        Data $helperData,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_helperData = $helperData;
        $this->collectionFactory = $collectionFactory;
        $this->questionFactory = $questionFactory;
    }

    /**
     * @return object
     */
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * @param string $sku
     *
     * @return \BodenkoVV\AskQuestion\Model\ResourceModel\Question\Collection
     */
    public function getQuestionByProductSku($sku = '')
    {
        $this->_helperData->currentProductId = $sku;
        $collection = $this->collectionFactory->create();
//        $questioModel = $this->questionFactory->create();
//        $questioModel->getCollection()->load();
//        $collection->addFieldToFilter('sku', ['eq'=>$sku]);
//        $collection->load();
       // $questioModel->beforeLoad();
        return $collection;
    }
}
