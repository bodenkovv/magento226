<?php

namespace BodenkoVV\AskQuestion\Block;

use \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
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

    /**
     * Requests constructor.
     * @param CollectionFactory $collectionFactory
     * @param Data $helperData
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Data $helperData,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_helperData = $helperData;
        $this->collectionFactory = $collectionFactory;
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
        $collectionFactory = $this->collectionFactory->create();
        $collectionFactory->addFieldToFilter('sku', ['eq'=>$sku]);

        return $collectionFactory;
    }
}
