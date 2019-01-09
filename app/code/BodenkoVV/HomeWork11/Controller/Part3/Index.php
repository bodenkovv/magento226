<?php
namespace BodenkoVV\HomeWork11\Controller\Part3;

use Magento\Customer\Block\Form\Register;
use Magento\Customer\Model\AccountManagement;
use Magento\Framework\Controller\ResultFactory;
use BodenkoVV\HomeWork11\Helper\Part3Helper;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $_pageFactory;
    protected $_register, $_part3Class;
    protected $_accountManagement;

    private $_classString; //='tessssst';
    private $_classObj; //=BodenkoVV\HomeWork11\NativePhp\part1;
    private $_classBool; //=false;
    private $_classInt; //=2;
    public $_classConstant; //=111;
    public $_classArray; //=[];


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
//        Part3Helper $part3Class,
        \Magento\Framework\View\Result\PageFactory $pageFactory
//        Register $register,
//        AccountManagement $accountManagement
)
    {
        $this->_pageFactory = $pageFactory;
  //      $this->_part3Class = $part3Class;
        //$this->_register = $register;
//        $this->_accountManagement = $accountManagement;
         parent::__construct($context);
    }

    public function execute()
    {
         $resultPage = $this->_pageFactory->create();


        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassString($this->_classString);
        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassObj($this->_classObj);
        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassBool($this->_classBool);
        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassInt($this->_classInt);
        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassConstant($this->_classConstant);
        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassArray(var_dump($this->_classArray));


//        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassString($this->_part3Class->_classString);
//        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassObj($this->_part3Class->_classObj);
//        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassBool($this->_part3Class->_classBool);
//        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassInt($this->_part3Class->_classInt);
//        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassConstant($this->_part3Class->_classConstant);
//        $resultPage->getLayout()->getBlock('customer_form_part3')->setClassArray(var_dump($this->_part3Class->_classArray));


//        $resultPage->getLayout()->getBlock('posts.list.count')->setBlogenable($this->_helperData->getGeneralConfig('enable'));
//        $resultPage->getLayout()->getBlock('posts.lists')->setBlogname($this->_helperData->getGeneralConfig('display_text'));
//        $resultPage->getLayout()->getBlock('formaddposts')->setBlogenable($this->_helperData->getGeneralConfig('enable'));
//        //$resultPage->getLayout()->getBlock('post.view')->setBlogenable($this->_helperData->getGeneralConfig('enable'));



        return $resultPage;
    }

}
