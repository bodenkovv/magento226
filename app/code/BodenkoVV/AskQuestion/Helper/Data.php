<?php

namespace BodenkoVV\AskQuestion\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\ScopeInterface;
use BodenkoVV\AskQuestion\Model\Question;
use BodenkoVV\AskQuestion\Model\QuestionFactory;
use BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use \Magento\Store\Model\StoreManagerInterface;

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

    /** @var PageFactory $resultPageFactory */
    protected $resultPageFactory;

    /** @var Registry $_registry */
    protected $_registry;

    /** @var $currentProductName */
    public $currentProductName;

    /** @var $currentProductSku */
    public $currentProductSku;

    /** @var $currentProductId */
    public $currentProductId;

    public $collectionFactory;

    /**
     * Data constructor.
     * @param Context $context
     * @param Question $postQuestion
     * @param QuestionFactory $postQuestionFactory
     * @param StoreManagerInterface $storeManager
     * @param PageFactory $resultPageFactory
     * @param CollectionFactory $collectionFactory
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Question $postQuestion,
        QuestionFactory $postQuestionFactory,
        StoreManagerInterface $storeManager,
        PageFactory $resultPageFactory,
        CollectionFactory $collectionFactory,
        Registry $registry
    )
    {
        parent::__construct($context);
        $this->_registry = $registry;
        $this->_postQuestion = $postQuestion;
        $this->_postQuestionFactory = $postQuestionFactory;
        $this->_storeManager = $storeManager;
        $this->collectionFactory = $collectionFactory;
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
        return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * @param $code
     * @param $storeId
     *
     * @return mixed
     */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_MODULE_MENU .'general/'. $code, $storeId);
    }
}
