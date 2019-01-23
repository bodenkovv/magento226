<?php

namespace BodenkoVV\AskQuestion\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use BodenkoVV\AskQuestion\Model\Question;
use BodenkoVV\AskQuestion\Model\QuestionFactory;
use \Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class Data
 * @package BodenkoVV\AskQuestion\Helper
 */
class Data extends AbstractHelper
{
    /** @var null $_post */
    protected $_post = null;

    /**
     * PostFactory
     * @var null|PostFactory
     */
    protected $_categoryPostFactory = null;

    /** @var string XML_PATH_MODULE_MENU */
    const XML_PATH_MODULE_MENU = 'askquestion/';

    /** @var QuestionFactory $_postQuestionFactory */
    public $_postQuestionFactory;

    /** @var Question $_postQuestion */
    public $_postQuestion;

    /** @var StoreManagerInterface $_storeManager */
    public $_storeManager;

    /** @var  $helperData */
    protected $helperData;

    /** @var \Magento\Framework\View\Result\PageFactory $resultPageFactory */
    protected $resultPageFactory;

    /** @var \Magento\Framework\Registry $_registry */
    protected $_registry;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param Question $postQuestion
     * @param QuestionFactory $postQuestionFactory
     * @param StoreManagerInterface $storeManager
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        Question $postQuestion,
        QuestionFactory $postQuestionFactory,
        StoreManagerInterface $storeManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        array $data= []
    )
    {
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->_postQuestion = $postQuestion;
        $this->_postQuestionFactory = $postQuestionFactory;
        $this->_storeManager = $storeManager;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return mixed current_product
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    /**
     * @param $field
     * @param $storeId
     *
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param $code
     * @param $storeId
     *
     * @return mixed
     */    public function getGeneralConfig($code, $storeId = null)
    {

        return $this->getConfigValue(self::XML_PATH_MODULE_MENU .'general/'. $code, $storeId);
    }
}
