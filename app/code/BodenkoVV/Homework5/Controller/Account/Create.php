<?php
namespace BodenkoVV\Homework5\Controller\Account;

use Magento\Customer\Block\Form\Register;
use Magento\Customer\Model\AccountManagement;
use Magento\Framework\Controller\ResultFactory;
class Create extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_register;
    protected $_accountManagement;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        Register $register,
        AccountManagement $accountManagement)
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

}
