<?php

namespace BodenkoVV\HomeWork10\Controller\Adminhtml\AskQuestion;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\Registry;
use \BodenkoVV\HomeWork10\Helper\Data;
//use Magento\Framework\App\Helper\AbstractHelper;

class Index extends \Magento\Backend\App\Action
{
    /** @var Data  */
    protected $_helperData;

    /** @var bool|PageFactory  */
	protected $resultPageFactory = false;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Data $helperData
     */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Data $helperData
    )
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
        $this->_helperData = $helperData;
	}

    /**
     * set block variables
     *
     * @return Page $resultPage
     */
	public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        if ($this->_helperData->getGeneralConfig('homework10_askquestion_enable'))
        {
            $resultPage->getConfig()->getTitle()->prepend((__($this->_helperData->getGeneralConfig('homework10_askquestion_title'))));
            $resultPage->getLayout()->getBlock('formaskquestion')->setAskQuestionEnable($this->_helperData->getGeneralConfig('homework10_askquestion_enable'));
            $resultPage->getLayout()->getBlock('formaskquestion')->setAskQuestionTitle($this->_helperData->getGeneralConfig('homework10_askquestion_title'));
            $resultPage->getLayout()->getBlock('formaskquestion')->setAskQuestionText($this->_helperData->getGeneralConfig('homework10_askquestion_text'));

            $resultPage->getLayout()->getBlock('bvv.ko.components')->setAskQuestionEnable($this->_helperData->getGeneralConfig('homework10_askquestion_enable'));
            $resultPage->getLayout()->getBlock('bvv.ko.components')->setAskQuestionTitle($this->_helperData->getGeneralConfig('homework10_askquestion_title'));
            $resultPage->getLayout()->getBlock('bvv.ko.components')->setAskQuestionText($this->_helperData->getGeneralConfig('homework10_askquestion_text'));
        } else
        {
            $resultPage->getConfig()->getTitle()->prepend((__('Module AskQuestion don`t active')));
        }

		return $resultPage;
	}
}
