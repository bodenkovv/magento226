<?php
namespace BodenkoVV\Homework5\Controller\account;

use Magento\Customer\Block\Form\Register;
use Magento\Customer\Model\AccountManagement;
use Magento\Framework\Controller\ResultFactory;
class create extends \Magento\Framework\App\Action\Action
{   protected $_pageFactory;
    protected $_register;
    protected $_accountManagement;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Block\Form\Register $register,
        \Magento\Customer\Model\AccountManagement $accountManagement)
    {
        $this->_pageFactory = $pageFactory;
        $this->_register = $register;
        $this->_accountManagement = $accountManagement;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }


//    public function execute()
//    {
//        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        return $resultPage;
//    }
}

