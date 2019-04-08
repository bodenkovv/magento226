<?php

namespace BodenkoVV\AskQuestion\Controller\Adminhtml\Question;

/**
 * Class Index
 * @package BodenkoVV\AskQuestion\Controller\Adminhtml\Question
 */
class Index extends \Magento\Backend\App\Action
{
    /** @var string  $_pageName*/
    protected $_pageName='Question';

    /** @var \Magento\Framework\View\Result\PageFactory $resultPageFactory*/
	protected $resultPageFactory;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

    /**
     * @return \Magento\Framework\View\Result\Page $resultPage
     */
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->addBreadcrumb(__($this->_pageName), __($this->_pageName));
        $resultPage->getConfig()->getTitle()->prepend(__($this->_pageName));
		return $resultPage;
	}
}
