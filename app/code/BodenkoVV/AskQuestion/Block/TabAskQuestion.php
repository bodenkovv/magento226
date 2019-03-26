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

    /** @var \Magento\Framework\Registry  */
    public $_registry;

    /** @var \Magento\Framework\View\Result\PageFactory  */
    public $resultPageFactory;

    public function __construct(
        CollectionFactory $collectionFactory,
        QuestionFactory $questionFactory,
//        Data $helperData,
        Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
//        $this->helperData = $helperData;
        $this->collectionFactory = $collectionFactory;
        $this->questionFactory = $questionFactory;
        $this->_registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
//        $resultPage = $this->resultPageFactory->create();
//        if ($this->helperData->getGeneralConfig('bodenkovv_askquestion_enable'))
//        {
//            $resultPage->getLayout()->getBlock('tabaskquestion.sample')->setAskQuestionEnable($this->helperData->getGeneralConfig('bodenkovv_askquestion_enable'));
//            $resultPage->getLayout()->getBlock('tabaskquestion.sample')->setAskQuestionTitle($this->helperData->getGeneralConfig('bodenkovv_askquestion_title'));
//            $resultPage->getLayout()->getBlock('tabaskquestion.sample')->setAskQuestionText($this->helperData->getGeneralConfig('bodenkovv_askquestion_description'));
//
//        } else
//        {
//            $resultPage->getConfig()->getTitle()->prepend((__('Module AskQuestion don`t active')));
//        }
//
//        return $resultPage;
    }

    /**
     * @return Collection
     */
    public function getQuestionByProductSku()
    {
        $collection = $this->collectionFactory->create();

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
