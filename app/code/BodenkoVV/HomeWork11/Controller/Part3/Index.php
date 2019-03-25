<?php

namespace BodenkoVV\HomeWork11\Controller\Part3;

use BodenkoVV\HomeWork11\Model\Part3Helper;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var  PageFactory*/
    public $_pageFactory;

    /** @var Part3Helper  */
    public $_part3Class;

    /**
     *Constructor
     *
     *@param \Context $context
     *@param Part3Helper $part3Class
     *@param PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        Part3Helper $part3Class,
        PageFactory $pageFactory
)
    {
        $this->_pageFactory = $pageFactory;
        $this->_part3Class = $part3Class;
         parent::__construct($context);
    }

    /**
     * broadcast variables to block - "customer_form_part"
     *
     * @return \Magento\Framework\View\Result\Page $resultPage
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getLayout()->getBlock('customer_form_part')->setClassString($this->_part3Class->_classString);
        $resultPage->getLayout()->getBlock('customer_form_part')->setClassObj($this->_part3Class->_classObj);
        $resultPage->getLayout()->getBlock('customer_form_part')->setClassBool($this->_part3Class->_classBool);
        $resultPage->getLayout()->getBlock('customer_form_part')->setClassInt($this->_part3Class->_classInt);
        $resultPage->getLayout()->getBlock('customer_form_part')->setClassConstant($this->_part3Class->_classConstant);
        $resultPage->getLayout()->getBlock('customer_form_part')->setClassArray($this->_part3Class->_classArray);
        $resultPage->getLayout()->getBlock('customer_form_part')->setClassAllVariable($this->_part3Class);

        return $resultPage;
    }
}
